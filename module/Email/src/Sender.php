<?php

namespace Email;

use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Transport\TransportInterface;

class Sender
{
    /**
     * @var TransportInterface
     */
    private $mailTransport;

    /**
     * @var array
     */
    private $options;

    /**
     * @var Builder
     */
    private $builder;

    /**
     * @param TransportInterface $mailTransport
     * @param Builder $builder
     * @param array $options
     */
    public function __construct(
        TransportInterface $mailTransport,
        Builder $builder,
        array $options = []
    ) {
        $this->mailTransport = $mailTransport;
        $this->options = $options;
        $this->builder = $builder;
    }

    /**
     * @param string $to
     * @param int $templateId
     * @param array $data
     * @param null $from
     * @param null $fromName
     */
    public function send($to, $templateId, array $data = [], $from = null, $fromName = null)
    {
        /** @var Template $template */
        if (!isset(Template::$idsArray[$templateId])) {
            throw new \RuntimeException("Can not send email. Template #$templateId not found.");
        }

        if (!$from) {
            if (!isset($this->options['sendFrom'])) {
                throw new \RuntimeException("Can not send email. Send from required.");
            }
            $from = $this->options['sendFrom'];
        }
        if (!$fromName) {
            $fromName = null;
            if (isset($this->options['sendFromName'])) {
                $fromName = $this->options['sendFromName'];
            }
        }
        $subject = $this->builder->buildSubject($templateId, $data);
        $bodyRaw = $this->builder->build($templateId, $data);

        $html = new MimePart($bodyRaw);
        $html->type = "text/html; charset=utf-8";
        $body = new MimeMessage();
        $body->addPart($html);

        $message = new Message();
        $message
            ->addFrom($from, $fromName)
            ->addTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setEncoding("UTF-8");

        $this->mailTransport->send($message);
    }
}
