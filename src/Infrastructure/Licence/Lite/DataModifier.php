<?php

namespace AmeliaBooking\Infrastructure\Licence\Lite;

/**
 * Class DataModifier
 *
 * @package AmeliaBooking\Infrastructure\Licence\Lite
 */
class DataModifier
{
    /**
     * @param array $settings
     */
    public static function modifySettings(&$settings)
    {
        $settings['payments']['cart'] = false;

        $settings['notifications']['whatsAppEnabled'] = false;

        $settings['payments']['stripe']['enabled'] = false;

        $settings['payments']['payPal']['enabled'] = false;

        $settings['payments']['razorpay']['enabled'] = false;

        $settings['payments']['mollie']['enabled'] = false;

        $settings['payments']['wc']['enabled'] = false;

        $settings['payments']['paymentLinks']['enabled'] = false;

        $settings['general']['usedLanguages'] = [];

        $settings['roles']['limitPerCustomerService']['enabled'] = false;

        $settings['roles']['limitPerCustomerPackage']['enabled'] = false;

        $settings['roles']['limitPerCustomerEvent']['enabled'] = false;

        $settings['roles']['limitPerEmployee']['enabled'] = false;

        $settings['roles']['allowCustomerCancelPackages'] = false;

        $settings['roles']['enableNoShowTag'] = false;

        $settings['appointments']['employeeSelection'] = 'random';
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public static function getUserRepositoryData($data)
    {
        return [
            'values'              =>
                [
                ],
            'columns'             =>
                '',
            'placeholders'        =>
                '',
            'columnsPlaceholders' =>
                '',
        ];
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public static function userFactory(&$data)
    {
        $data['locationId'] = null;

        $data['googleCalendar'] = null;

        $data['outlookCalendar'] = null;

        $data['badgeId'] = null;

        $data['zoomUserId'] = null;

        $data['translations'] = null;

        $data['timeZone'] = null;

        if (!empty($data['serviceList'])) {
            foreach ($data['serviceList'] as $key => $value) {
                $data['serviceList'][$key]['customPricing'] = null;
            }
        }
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public static function getProviderServiceRepositoryData($data)
    {
        return [
            'values'              =>
                [
                ],
            'columns'             =>
                '',
            'placeholders'        =>
                '',
            'columnsPlaceholders' =>
                '',
        ];
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public static function providerServiceFactory(&$data)
    {
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public static function getPeriodRepositoryData($data)
    {
        return [
            'values'              =>
                [
                ],
            'columns'             =>
                '',
            'placeholders'        =>
                '',
            'columnsPlaceholders' =>
                '',
        ];
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public static function periodFactory(&$data)
    {
        $data['locationId'] = null;

        $data['periodLocationList'] = [];
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public static function getServiceRepositoryData($data)
    {
        return [
            'values'              =>
                [
                ],
            'columns'             =>
                '',
            'placeholders'        =>
                '',
            'columnsPlaceholders' =>
                '',
        ];
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public static function serviceFactory(&$data)
    {
        $data['recurringCycle'] = 'disabled';

        $data['recurringSub'] = 'future';

        $data['recurringPayment'] = 0;

        $data['customPricing'] = null;

        $data['limitPerCustomer'] = null;

        $data['deposit'] = 0;

        $data['depositPayment'] = 'disabled';

        $data['depositPerPerson'] = 1;

        $data['fullPayment'] = 0;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public static function getEventRepositoryData($data)
    {
        return [
            'values'              =>
                [
                ],
            'addValues'           =>
                [
                ],
            'columns'             =>
                '',
            'placeholders'        =>
                '',
            'columnsPlaceholders' =>
                '',
        ];
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public static function eventFactory(&$data)
    {
        $data['ticketRangeRec'] = 'calculate';

        $data['deposit'] = 0;

        $data['depositPayment'] = 'disabled';

        $data['fullPayment'] = 0;

        $data['customPricing'] = 0;

        $data['depositPerPerson'] = 1;

        $data['locationId'] = null;
    }
}
