<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatRoomApiController extends Controller
{
    /**
     * The index method is used to get all chat rooms of authenticated user.
     * It checks the user's role, so that it can determine which part of id_user in table ChatRoom to check.
     * If the user's role is Dosen, then it will get the chat rooms which contain the user's id in id_user_2. Since we refer id_user_2 belongs to the user's id with the role Dosen
     * If the user's role is Siswa, then it will get the chat rooms which contain the user's id in id_user_1. Since we refer id_user_1 belongs to the user's id with the role Siswa
     *
     * The chat rooms that are returned will be sorted by the updated_at column. The updated_at will be updated when new chat is sent in the corresponding chat room.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Checking if authenticated user is Dosen
        if (Auth::user()->role == 'Dosen') {
            $chatRoom = ChatRoom::orderBy('updated_at', 'desc')->where('id_user_2', Auth::user()->id)->get();
            foreach ($chatRoom as $cr) {
                // This will convert the form of true or false from the database that is saved is 1 or 0
                if($cr->is_automatic_deleted == 1){
                    $cr->is_automatic_deleted = true;
                }
                else{
                    $cr->is_automatic_deleted = false;
                }

                // This will check the days difference between the last edited date of the chat room
                // (edited is discussing when user chose whether the chat room will be deleted automatically or not)
                // and the date when the chat room was last updated
                // (updated is when the chat room was last accessed or when the last message was sent)
                // So, if user Siswa lets the chat room be deleted automatically, then the chat room will be deleted after 28 days
                $daysDiff = $cr->getDiffInDaysAttribute();
                if($daysDiff >= 28 && $cr->is_automatic_deleted == true){
                    $cr->delete();
                }

                $cr->user = User::find($cr->id_user_1, ['nama', 'foto_profil']); // This will take the data of user that Dosen chats with.
            }
        }

        // Checking if authenticated user is Siswa
        if (Auth::user()->role == 'Siswa') {
            $chatRoom = ChatRoom::orderBy('updated_at', 'desc')->where('id_user_1', Auth::user()->id)->get();
            foreach ($chatRoom as $cr) {
                // This will convert the form of true or false from the database that is saved is 1 or 0
                if($cr->is_automatic_deleted == 1){
                    $cr->is_automatic_deleted = true;
                }
                else{
                    $cr->is_automatic_deleted = false;
                }

                // This will check the days difference between the last edited date of the chat room
                // (edited is discussing when user chose whether the chat room will be deleted automatically or not)
                // and the date when the chat room was last updated
                // (updated is when the chat room was last accessed or when the last message was sent)
                // So, if user Siswa lets the chat room be deleted automatically, then the chat room will be deleted after 28 days
                $daysDiff = $cr->getDiffInDaysAttribute();
                if($daysDiff >= 28 && $cr->is_automatic_deleted == true){
                    $cr->delete();
                }

                $cr->user = User::find($cr->id_user_2, ['nama', 'foto_profil']); // This will take the data of user that Siswa chats with.
            }
        }

        // Returning the chat rooms
        return response()->json([
            'code' => 200,
            'message' => 'All chat rooms retrieved successfully',
            'chatRoom' => $chatRoom,
        ]);
    }

    /**
     * This method is used to make a new chat room between two users.
     * The id_user_1 will save the id of the user that has role Siswa.
     * The id_user_2 will save the id of the user that has role Dosen.
     *
     * Depending which user is the authenticated user, the id_user_1 or id_user_2 will be the same with the authenticated user's id.
     * So suppose that the authenticated user is the user with id 1 and user's role is Siswa, then the id_user_1 will be 1 and id_user_2 will be something received from the $request.
     * Another one,
     * Suppose that the authenticated user is the user with id 2 and user's role is Dosen, then the id_user_1 will be will be something received from the request and id_user_2 will be 2.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeNewChatRoom(Request $request)
    {
        $chatRoom = null;

        if (Auth::user()->id == $request->id_user) {
            return response()->json([
                'code' => 400,
                'message' => 'You cannot chat with yourself',
                'chatRoom' => $chatRoom,
            ]);
        }

        if (Auth::user()->role == 'Dosen') {
            $chatRoom = ChatRoom::where('id_user_1', $request->id_user)->where('id_user_2', Auth::user()->id)->first();
            if ($chatRoom) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Chat room already exists',
                    'chatRoom' => $chatRoom,
                ]);
            }

            $chatRoom = new ChatRoom();
            $chatRoom->id_user_1 = (int)$request->id_user;
            $chatRoom->id_user_2 = Auth::user()->id;
            $chatRoom->save();
        }

        if (Auth::user()->role == 'Siswa') {
            $chatRoom = ChatRoom::where('id_user_1', Auth::user()->id)->where('id_user_2', $request->id_user)->first();
            if ($chatRoom) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Chat room already exists',
                    'chatRoom' => $chatRoom,
                ]);
            }

            $chatRoom = new ChatRoom();
            $chatRoom->id_user_1 = Auth::user()->id;
            $chatRoom->id_user_2 = (int)$request->id_user;
            $chatRoom->save();
        }

        return response()->json([
            'code' => 200,
            'message' => 'Chat room created successfully',
            'chatRoom' => $chatRoom,
        ]);
    }

    /**
     * This method is to show the details of chats between two users contained in a chat room.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $chatRoom = ChatRoom::find($id);

        if (!$chatRoom) {
            return response()->json([
                'code' => 404,
                'message' => 'Chat room not found',
                'chatRoom' => null,
            ]);
        }

        if (Auth::user()->role == 'Dosen') {
            if ($chatRoom->id_user_2 != Auth::user()->id) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Chat room not found',
                    'chatRoom' => $chatRoom,
                ]);
            }

            // This will convert the form of true or false from the database that is saved is 1 or 0
            if($chatRoom->is_automatic_deleted == 1){
                $chatRoom->is_automatic_deleted = true;
            }
            else{
                $chatRoom->is_automatic_deleted = false;
            }

            $chatRoom->user = User::find($chatRoom->id_user_1, ['nama', 'foto_profil']); // This will take the data of user that Dosen chats with.
            // Think it this way, when the authenticated user is Dosen, the user Data that must be gotten is the user's with role Siswa that this Dosen chats with.
        }

        if (Auth::user()->role == 'Siswa') {
            if ($chatRoom->id_user_1 != Auth::user()->id) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Chat room not found',
                    'chatRoom' => $chatRoom,
                ]);
            }

            // This will convert the form of true or false from the database that is saved is 1 or 0
            if($chatRoom->is_automatic_deleted == 1){
                $chatRoom->is_automatic_deleted = true;
            }
            else{
                $chatRoom->is_automatic_deleted = false;
            }

            $chatRoom->user = User::find($chatRoom->id_user_2, ['nama', 'foto_profil']); // This will take the data of user that Siswa chats with.
            // Think it this way, when the authenticated user is Siswa, the user Data that must be gotten is the user's with role Dosen that this Siswa chats with.
        }

        return response()->json([
            'code' => 200,
            'message' => 'Chat room retrieved successfully',
            'chatRoom' => $chatRoom,
            'chats' => ChatApiController::showAllChatsInChatRoom($chatRoom->id, $chatRoom->id_user_1, $chatRoom->id_user_2),
        ]);
    }

    /**
     * This method is to send new chat to a chat room.
     * Everytime a new chat is sent, the chat room's updated_at will be updated.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeNewChat(Request $request, int $id)
    {
        $validation = Validator::make($request->all(), [
            'pesan' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Validation failed',
                'errors' => $validation->errors(),
                'chatRoom' => null,
                'chat' => null,
            ]);
        }

        $chatRoom = ChatRoom::find($id);

        if (!$chatRoom) {
            return response()->json([
                'code' => 404,
                'message' => 'Chat room not found',
                'chatRoom' => null,
                'chat' => null,
            ]);
        }

        if (Auth::user()->role == 'Dosen') {
            if ($chatRoom->id_user_2 != Auth::user()->id) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Chat room not found',
                    'chatRoom' => $chatRoom,
                    'chat' => null,
                ]);
            }
        }

        if (Auth::user()->role == 'Siswa') {
            if ($chatRoom->id_user_1 != Auth::user()->id) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Chat room not found',
                    'chatRoom' => $chatRoom,
                    'chat' => null,
                ]);
            }
        }

        /* Adding new chat to the chat room */
        $chat = ChatApiController::sendMessage($request, $chatRoom->id);
        /* End of adding new chat to the chat room */

        /* Updating the chat room's updated_at */
        $chatRoom->updated_at = now();
        $chatRoom->save();
        /* End of updating the chat room's updated_at */

        return response()->json([
            'code' => 200,
            'message' => 'Chat created successfully',
            'chatRoom' => $chatRoom,
            'chat' => $chat,
        ]);
    }

    /**
     * This method is to update whether the chat room is automatically deleted or not.
     * It will accept the request with name 'is_automatic_deleted' and the value of the request is either 1 or 0.
     * 1 represents true, that is, the chat room will be automatically deleted.
     * 0 represents false, that is, the chat room will not be automatically deleted.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateChatRoom(Request $request, int $id)
    {
        // Only user with role Siswa can perform this action
        if(Auth::user()->role != 'Siswa') {
            return response()->json([
                'code' => 403,
                'message' => 'Forbidden',
                'chatRoom' => null,
            ]);
        }

        $validation = Validator::make($request->all(), [
            'is_automatic_deleted' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Validation failed',
                'errors' => $validation->errors(),
                'chatRoom' => null,
            ]);
        }

        $chatRoom = ChatRoom::find($id);
        if(!$chatRoom) {
            return response()->json([
                'code' => 404,
                'message' => 'Chat room not found',
                'chatRoom' => null,
            ]);
        }

        if($request->is_automatic_deleted == 1) {
            $chatRoom->is_automatic_deleted = true;
        } else {
            $chatRoom->is_automatic_deleted = false;
        }

        // Later, we will check the differences between the last_edited_at and the updated_at
        // If the difference is more than 28 days, then the chat room will be deleted
        $chatRoom->last_edited_at = now();
        $chatRoom->save();

        return response()->json([
            'code' => 200,
            'message' => 'Chat room updated successfully',
            'chatRoom' => $chatRoom,
        ]);
    }
}
