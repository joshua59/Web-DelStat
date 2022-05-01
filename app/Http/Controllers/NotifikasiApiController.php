<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;

class NotifikasiApiController extends Controller
{
    /**
     * This static method will be invoked when a new analisis data is added
     * The invocation of this method will be done by the AnalisisDataApiController
     *
     * @param $id_literatur
     * @return void
     */
    public static function newAnalisisData($id_analisis_data)
    {
        $user = User::all()->where('role', 'Dosen');

        foreach ($user as $u) {
            Notifikasi::create([
                'id_user' => $u->id,
                'id_analisis_data' => $id_analisis_data,
                'jenis_notifikasi' => 'Request Analisis Data Baru',
            ]);
        }
    }

    /**
     * This static method will be invoked when a new literatur is added
     * The invocation of this method will be done by the LiteraturApiController
     *
     * @param $id_literatur
     * @return void
     */
    public static function newLiteratur($id_literatur)
    {
        $user = User::all()->where('role', 'Siswa');

        foreach ($user as $u) {
            Notifikasi::create([
                'id_user' => $u->id,
                'id_literatur' => $id_literatur,
                'jenis_notifikasi' => 'Literatur Baru',
            ]);
        }
    }

    /**
     * This method will pretty much do all the jobs of the controller.
     * It will get all the notifications for the user authenticated.
     * It will iterate through the notifications and will do some checking
     * to see if the notification is still valid.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function index()
    {
        $notifikasiData = Notifikasi::all()->where('id_user', auth()->user()->id);
        $notifikasi = [];

        foreach ($notifikasiData as $n) {
            // This will check if the notification is unread and if it is, it will mark it as read.
            if($n->read_at == null && $n->sudah_dibaca == false) {
                $n->read_at = now();
                $n->sudah_dibaca = true;
            }

            // This will update the last time the user checked the notification.
            $n->updated_at = now();

            // This will check if the notification is still valid.
            // Valid means that the notification is 7 days old from the time it was read by the user.
            $daysDiff = $n->getDiffInDaysAttribute();
            // If the days difference is greater than 7 (days), then the notification is not valid anymore.
            if($daysDiff >= 7) {
                $n->delete(); // therefore, it will be deleted.
            }
            // Otherwise, the notification will be updated.
            else {
                $n->save();
                array_push($notifikasi, $n);
            }
        }

        return response()->json([
            'code' => 200,
            'message' => [
                'value' => 'Notification data retrieved successfully',
            ],
            'notifikasi' => $notifikasi,
        ]);
    }
}
