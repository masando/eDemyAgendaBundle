<?php

namespace eDemy\AgendaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class eDemyAgendaBundle extends Bundle
{
    public static function getBundleName($type = null)
    {
        if ($type == null) {

            return 'eDemyAgendaBundle';
        } else {
            if ($type == 'Simple') {

                return 'Agenda';
            } else {
                if ($type == 'simple') {

                    return 'agenda';
                }
            }
        }
    }

    public static function eDemyBundle() {

        return true;
    }
}
