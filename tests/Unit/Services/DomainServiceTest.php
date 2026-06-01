<?php

namespace Tests\Unit\Services;

use App\Services\DomainService;
use PHPUnit\Framework\TestCase;

class DomainServiceTest extends TestCase
{
    public function test_strips_http_and_www_and_appends_tld(): void
    {
        $this->assertSame('example.com', DomainService::filter('http://www.example.com/', 'com'));
    }

    public function test_strips_https_and_www(): void
    {
        $this->assertSame('example.net', DomainService::filter('https://www.example.net/', 'net'));
    }

    public function test_strips_existing_tld_and_replaces_with_given_tld(): void
    {
        $this->assertSame('example.net', DomainService::filter('example.com', 'net'));
    }

    public function test_domain_without_dot_appends_tld(): void
    {
        $this->assertSame('test.net', DomainService::filter('test', 'net'));
    }

    public function test_strips_www_without_protocol(): void
    {
        $this->assertSame('domain.com', DomainService::filter('www.domain.com', 'com'));
    }

    public function test_plain_domain_with_matching_tld(): void
    {
        $this->assertSame('mysite.id', DomainService::filter('mysite.id', 'id'));
    }
}
