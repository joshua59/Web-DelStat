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
                $cr->user = User::find($cr->id_user_1, ['nama', 'foto_profil']); // This will take the data of user that Dosen chats with.
            }
        }

        // Checking if authenticated user is Siswa
        if (Auth::user()->role == 'Siswa') {
            $chatRoom = ChatRoom::orderBy('updated_at', 'desc')->where('id_user_1', Auth::user()->id)->get();
            foreach ($chatRoom as $cr) {
                $cr->user = User::find($cr->id_user_2, ['nama', 'foto_profil']); // This will take the data of user that Siswa chats with.
            }
        }

        // Returning the chat rooms
        return response()->json([
            'code' => 200,
            'message' => [
                'value' => 'All chat rooms retrieved successfully',
            ],
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
                'message' => [
                    'value' => 'You cannot chat with yourself',
                ],
                'chatRoom' => $chatRoom,
            ]);
        }

        if (Auth::user()->role == 'Dosen') {
            $chatRoom = ChatRoom::where('id_user_1', $request->id_user)->where('id_user_2', Auth::user()->id)->first();
            if ($chatRoom) {
                return response()->json([
                    'code' => 400,
                    'message' => [
                        'value' => 'Chat room already exists',
                    ],
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
                    'message' => [
                        'value' => 'Chat room already exists',
                    ],
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
            'message' => [
                'value' => 'Chat room created successfully',
            ],
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
                'message' => [
                    'value' => 'Chat room not found',
                ],
                'chatRoom' => null,
            ]);
        }

        if (Auth::user()->role == 'Dosen') {
            if ($chatRoom->id_user_2 != Auth::user()->id) {
                return response()->json([
                    'code' => 400,
                    'message' => [
                        'value' => 'Chat room not found',
                    ],
                    'chatRoom' => $chatRoom,
                ]);
            }
            $chatRoom->user = User::find($chatRoom->id_user_1, ['nama', 'foto_profil']); // This will take the data of user that Dosen chats with.
            // Think it this way, when the authenticated user is Dosen, the user Data that must be gotten is the user's with role Siswa that this Dosen chats with.
        }

        if (Auth::user()->role == 'Siswa') {
            if ($chatRoom->id_user_1 != Auth::user()->id) {
                return response()->json([
                    'code' => 400,
                    'message' => [
                        'value' => 'Chat room not found',
                    ],
                    'chatRoom' => $chatRoom,
                ]);
            }
            $chatRoom->user = User::find($chatRoom->id_user_2, ['nama', 'foto_profil']); // This will take the data of user that Siswa chats with.
            // Think it this way, when the authenticated user is Siswa, the user Data that must be gotten is the user's with role Dosen that this Siswa chats with.
        }

        return response()->json([
            'code' => 200,
            'message' => [
                'value' => 'Chat room retrieved successfully',
            ],
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
                'pesan' => $validation->errors(),
                'chatRoom' => null,
                'chat' => null,
            ]);
        }

        $chatRoom = ChatRoom::find($id);

        if (!$chatRoom) {
            return response()->json([
                'code' => 404,
                'message' => [
                    'value' => 'Chat room not found',
                ],
                'chatRoom' => null,
            ]);
        }

        if (Auth::user()->role == 'Dosen') {
            if ($chatRoom->id_user_2 != Auth::user()->id) {
                return response()->json([
                    'code' => 400,
                    'message' => [
                        'value' => 'Chat room not found',
                    ],
                    'chatRoom' => $chatRoom,
                ]);
            }
        }

        if (Auth::user()->role == 'Siswa') {
            if ($chatRoom->id_user_1 != Auth::user()->id) {
                return response()->json([
                    'code' => 400,
                    'message' => [
                        'value' => 'Chat room not found',
                    ],
                    'chatRoom' => $chatRoom,
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
            'message' => [
                'value' => 'Chat created successfully',
            ],
            'chatRoom' => $chatRoom,
            'chat' => $chat,
        ]);
    }
}
