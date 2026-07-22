<?php

namespace App\Enum\Mail;

enum MailProfile: string
{
    case DEFAULT = 'default';
    case SUPPORT = 'support';
    case MARKETING = 'marketing';
    case ORDERS = 'orders';
    case BILLING = 'billing';
}
