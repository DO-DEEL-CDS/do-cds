<?php

namespace App\Extensions\QrCode\Model;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * App\Backend\QrCode\Model\QrCode
 *
 * @property string code
 * @property string qr_image
 * @property boolean active
 * @property MorphTo|null qr_code_able
 * @property array metadata
 *
 *
 * Class QrCode
 * @package App\Backend\QrCode\Model
 * @property int $id
 * @property string|null $qr_code_able_type
 * @property int|null $qr_code_able_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|Eloquent $qrCodeAble
 * @method static Builder|QrCode newModelQuery()
 * @method static Builder|QrCode newQuery()
 * @method static Builder|QrCode query()
 * @method static Builder|QrCode whereActive($value)
 * @method static Builder|QrCode whereCode($value)
 * @method static Builder|QrCode whereCreatedAt($value)
 * @method static Builder|QrCode whereDeletedAt($value)
 * @method static Builder|QrCode whereId($value)
 * @method static Builder|QrCode whereMetadata($value)
 * @method static Builder|QrCode whereQrCodeAbleId($value)
 * @method static Builder|QrCode whereQrCodeAbleType($value)
 * @method static Builder|QrCode whereQrImage($value)
 * @method static Builder|QrCode whereUpdatedAt($value)
 * @mixin Eloquent
 */
class QrCode extends Model
{
    use HasFactory;

    protected $table = 'qr_codes';

    protected $guarded = ['id'];


    public function getRouteKeyName()
    {
        return 'code';
    }

    public function qrCodeAble()
    {
        return $this->morphTo('qr_code_able');
    }

    public function getApiLink()
    {
        return route('api.v1.qrcodes.verify', ['code' => $this->code]);
    }

    public function getQrCodeImagePath()
    {
        return asset('qr_codes/' . $this->qr_image);
    }

    public function getEncodedQr()
    {
        if (!$this->qr_image) {
            $this->qr_image = 'data:image/png;base64, ' .
                    base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(300)->generate($this->code));
            $this->update();
        }

        return $this->qr_image;
    }
}
