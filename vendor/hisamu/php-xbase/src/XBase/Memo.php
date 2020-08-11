<?php

namespace XBase;

use XBase\Memo\AbstractMemo;

/**
 * @deprecated since 1.2. You should create new instance via MemoFactory.
 */
class Memo extends AbstractMemo
{
    public function get($data)
    {
        if ($data && 2 === strlen($data)) {
            $pointer = unpack('s', $data)[1];
            return $this->getData($pointer);
        } else {
            return $data;
        }
    }

    protected function getData($pointer)
    {
        $value = null;
        if ($this->fp && 0 != $pointer) {
            // Getting block size
            fseek($this->fp, 6);
            $data = unpack('n', fread($this->fp, 2));
            $memoBlockSize = $data[1];

            fseek($this->fp, $pointer * $memoBlockSize);
            $type = unpack('N', fread($this->fp, 4));
            if ('1' == $type[1]) {
                $len = unpack('N', fread($this->fp, 4));
                $value = trim(fread($this->fp, $len[1]));
                if ($this->table->getConvertFrom()) {
                    $value = iconv($this->table->getConvertFrom(), 'utf-8', $value);
                }
            } else {
                // Pictures will not be shown
                $value = '{BINARY_PICTURE}';
            }
        }
        return $value;
    }
}
