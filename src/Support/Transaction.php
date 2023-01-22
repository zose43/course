<?php

declare(strict_types = 1);

namespace Support;

use DB;
use Exception;

final class Transaction
{
    /**
     * @throws Exception
     */
    public static function run(
        callable $callback,
        callable $finished = null,
        callable $onError = null
    ): mixed
    {
        try {
            DB::beginTransaction();

            return tap($callback(), static function ($result) use ($finished) {
                DB::commit();

                if (!is_null($finished)) {
                    $finished();
                }
            });
        } catch (Exception $e) {
            DB::rollBack();

            if (!is_null($onError)) {
                $onError($e);
            }

            throw $e;
        }
    }
}