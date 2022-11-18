<?php

namespace EmizorIpx\WhatsappCloudapi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    protected $table = 'cloud_whatsapp_messages';

    protected $guarded = [];

    const DISPATCHED_STATE = 'dispatched';
    const SENT_STATE = 'sent';
    const DELIVERED_STATE = 'delivered';
    const READ_STATE = 'read';
    const DELETED_STATE = 'deleted';
    const FAILED_STATE = 'failed';

    const SUCCESS_STATUS = 'success';
    const FAILED_STATUS = 'failed';


}
