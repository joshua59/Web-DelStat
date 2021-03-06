<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class ChatRoom extends Model
{
    use HasFactory;

    protected $table = "chat_room";

    /**
     * Use id_user_1 for to refer to user with role Siswa
     * Use id_user_2 for to refer to user with role Dosen
     *
     * @var string[]
     */
    protected $fillable = [
        'id_user_1',
        'id_user_2',
        'is_automatic_deleted',
        'last_accessed_at',
    ];

    /**
     * This function finds the difference in days between the date of the chat room last edited
     * (edited is discussing to choose whether the chat room will be deleted automatically or not)
     * and the date when the chat room was last updated
     * (updated is when the chat room was last accessed or when the last message was sent)
     *
     * @return mixed
     */
    public function getDiffInDaysAttribute()
    {
        return $this->updated_at->diffInDays($this->last_edited_at);
    }

    public function convertToBoolean()
    {
        if($this->is_automatic_deleted == 1)
        {
            $this->is_automatic_deleted = true;
        }
        else
        {
            $this->is_automatic_deleted = false;
        }
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        /*return $date->format('d M Y, H:i:s');*/
        $long = strtotime($date->format('Y-m-d H:i:s'));
        return (string)$long;
    }
}
