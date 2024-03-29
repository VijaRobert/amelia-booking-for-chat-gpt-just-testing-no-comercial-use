<?php

namespace AmeliaBooking\Application\Commands\Outlook;

use AmeliaBooking\Application\Commands\CommandHandler;
use AmeliaBooking\Application\Commands\CommandResult;
use AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException;
use AmeliaBooking\Domain\Factory\Outlook\OutlookCalendarFactory;
use AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException;
use AmeliaBooking\Infrastructure\Services\Outlook\AbstractOutlookCalendarService;
use AmeliaBooking\Infrastructure\Repository\Outlook\OutlookCalendarRepository;

/**
 * Class FetchAccessTokenWithAuthCodeOutlookCommandHandler
 *
 * @package AmeliaBooking\Application\Commands\Outlook
 */
class FetchAccessTokenWithAuthCodeOutlookCommandHandler extends CommandHandler
{
    /** @var array */
    public $mandatoryFields = [
        'authCode',
        'userId'
    ];

    /**
     * @param FetchAccessTokenWithAuthCodeOutlookCommand $command
     *
     * @return CommandResult
     * @throws InvalidArgumentException
     * @throws QueryExecutionException
     */
    public function handle(FetchAccessTokenWithAuthCodeOutlookCommand $command)
    {
        $result = new CommandResult();

        $this->checkMandatoryFields($command);

        /** @var OutlookCalendarRepository $outlookCalendarRepository */
        $outlookCalendarRepository = $this->container->get('domain.outlook.calendar.repository');

        /** @var AbstractOutlookCalendarService $outlookCalendarService */
        $outlookCalendarService = $this->container->get('infrastructure.outlook.calendar.service');

        $token = $outlookCalendarService->fetchAccessTokenWithAuthCode(
            $command->getField('authCode'),
            $command->getField('redirectUri')
        );

        if (!$token['outcome']) {
            $result->setResult(CommandResult::RESULT_ERROR);
            $result->setData($token);
            $result->setMessage($token['result']);

            return $result;
        }

        $outlookCalendar = OutlookCalendarFactory::create(['token' => $token['result']]);

        $outlookCalendarRepository->beginTransaction();

        if (!$outlookCalendarRepository->add($outlookCalendar, $command->getField('userId'))) {
            $outlookCalendarRepository->rollback();
        }

        $outlookCalendarRepository->commit();

        $result->setResult(CommandResult::RESULT_SUCCESS);
        $result->setMessage('Successfully fetched access token');

        return $result;
    }
}
