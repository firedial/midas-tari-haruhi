<?php
declare(strict_types=1);

namespace App\ValueObject;

use App\Exceptions\ValueObjectException;
use App\Models\KindElement;
use App\Models\PurposeElement;
use App\Models\PlaceElement;


class BalanceValueObject
{
    private int $id;
    private int $amount;
    private string $item;
    private int $kindElementId;
    private int $purposeElementId;
    private int $placeElementId;
    private string $date;

    public function __construct(
        int $id,
        int $amount,
        string $item,
        int $kindElementId,
        int $purposeElementId,
        int $placeElementId,
        string $date,
    )
    {
        $this->id = $id;

        if ($amount === 0) {
            throw new ValueObjectException('Amount is zero.');
        }
        $this->amount = $amount;

        if ($item === '') {
            throw new ValueObjectException('item is empty string.');
        }
        $this->item = $item;

        if ($kindElementId === KindElement::MOVE_ID) {
            throw new ValueObjectException('Kind element id is move id.');
        }
        $this->kindElementId = $kindElementId;

        if ($purposeElementId === PurposeElement::MOVE_ID) {
            throw new ValueObjectException('Purpose element id is move id.');
        }
        $this->purposeElementId = $purposeElementId;

        if ($placeElementId === PlaceElement::MOVE_ID) {
            throw new ValueObjectException('Place element id is move id.');
        }
        $this->placeElementId = $placeElementId;

        if (!self::isDateForm($date)) {
            throw new ValueObjectException('Date is wrong.');
        }
        $this->date = $date;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getItem(): string
    {
        return $this->item;
    }

    public function getKindElementId(): int
    {
        return $this->kindElementId;
    }

    public function getPurposeElementId(): int
    {
        return $this->purposeElementId;
    }

    public function getPlaceElementId(): int
    {
        return $this->placeElementId;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    private static function isDateForm(string $date): bool
    {
        // @todo ゆくゆくはハイフンの区切り文字だけの対応とする
        $date = str_replace('/', '-', $date);

        if (!strptime($date, '%Y-%m-%d')) {
            return false;
        }

        $splitedDate = explode('-', $date);
        $year = (int)$splitedDate[0];
        $month = (int)$splitedDate[1];
        $day = (int)$splitedDate[2];
        if (!checkdate($month, $day, $year)) {
            return false;
        }

        // かけ離れていたら false とする
        if ($year <= 1990 || 2100 <= $year) {
            return false;
        }

        return true;
    }

}

