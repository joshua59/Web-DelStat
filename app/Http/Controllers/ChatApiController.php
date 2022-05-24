<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatApiController extends Controller
{
    /**
     * This method is used to get all chats in one chat room.
     * Every chat that hasn't been read before will be marked as read by updating the column sudah_dibaca to 1 (true) and read_at to current time (when this method is invoked).
     * The updated_at column will be updated to the time of this method's invokation as well.
     *
     * @param int $id_chat_room
     * @param int $id_user_1
     * @param int $id_user_2
     * @return null
     */
    public static function showAllChatsInChatRoom(int $id_chat_room, int $id_user_1, int $id_user_2)
    {
        // $chat = Chat::where('id_chat_room', $id_chat_room)->get()->orderBy('created_at', 'desc');
        $chat = Chat::orderBy('created_at', 'desc')->orderBy('id', 'desc')->where('id_chat_room', $id_chat_room)->get();

        if(!$chat){
            /*return response()->json([
                'code' => 404,
                'message' => 'Chats not found',
                'chat' => null,
            ]);*/
            return null;
        }

        // If the user that accesses the chat room is Siswa, then every chat that was sent by Dosen will be set to read
        if(Auth::user()->id == $id_user_1){
            foreach ($chat as $c) {
                if($c->id_user == $id_user_2 && $c->sudah_dibaca == false){
                    $c->sudah_dibaca = true;
                    $c->read_at = now();
                }
                $c->updated_at = now(); // update the last time the chat was accessed
                $c->save();

                // This will convert the form of true or false from the database that is saved as 1 or 0
                if($c->sudah_dibaca == 1){
                    $c->sudah_dibaca = true;
                }
                else {
                    $c->sudah_dibaca = false;
                }
            }
        }

        // If the user that accesses the chat room is Dosen, then every chat that was sent by Siswa will be set to read
        if(Auth::user()->id == $id_user_2){
            foreach ($chat as $c) {
                if($c->id_user == $id_user_1 && $c->sudah_dibaca == false){
                    $c->sudah_dibaca = true;
                    $c->read_at = now();
                }
                $c->updated_at = now(); // update the last time the chat was accessed
                $c->save();

                // This will convert the form of true or false from the database that is saved as 1 or 0
                if($c->sudah_dibaca == 1){
                    $c->sudah_dibaca = true;
                }
                else {
                    $c->sudah_dibaca = false;
                }
            }
        }

        /*return response()->json([
            'code' => 200,
            'message' => [
                'value' => 'Chats retrieved successfully',
            ],
            'chat' => $chat,
        ]);*/
        return $chat;
    }

    /**
     * This method is used to send a chat message to a chat room.
     *
     * @param Request $request
     * @param int $id_chat_room
     * @return Chat
     */
    public static function sendMessage(Request $request, int $id_chat_room)
    {
        $chat = new Chat();
        $chat->id_chat_room = $id_chat_room;
        $chat->id_user = Auth::user()->id;
        $chat->role = Auth::user()->role;
        $chat->pesan = $request->pesan;
        $chat->save();

        /*return response()->json([
            'code' => 200,
            'message' => [
                'value' => 'Chat created successfully',
            ],
            'chat' => $chat,
        ]);*/

        return $chat;
    }
}
