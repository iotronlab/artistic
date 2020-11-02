<?php

namespace App\Types;

use App\Repositories\Product\ProductRepository;

class Simple extends AbstractType
{
    protected $skipAttributes = [];
    //simple methods declared in AbstractType

    public function isSaleable()
    {
        if ((int)$this->haveSufficientQuantity() >= 1) {
            return true;
        }

        return false;
    }

    /**
     * @param  int  $qty
     * @return bool
     */
    public function haveSufficientQuantity()
    {
        return $this->totalQuantity();
    }
}
