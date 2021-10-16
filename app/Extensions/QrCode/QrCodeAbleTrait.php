<?php

namespace App\Extensions\QrCode;


use App\Extensions\QrCode\Model\QrCode;
use Illuminate\Support\Str;

trait QrCodeAbleTrait
{
    public function qrCode()
    {
        return $this->morphOne(QrCode::class, 'qr_code_able');
    }

    public function generateAndAssignQrCode($value = null)
    {
        if ($value == null) {
            $value = Str::random();
        }

        /** @var QrCode $qr_code */
        $qr_code = QrCode::query()->create([
            'code' => $value
        ]);

        $this->assignQrCode($qr_code);
    }

    public function assignQrCode(QrCode $qrCode)
    {
        $qrCode->qrCodeAble()->associate($this);
        $qrCode->update([
            'active' => true
        ]);
    }

}
