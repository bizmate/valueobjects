<?php

namespace ValueObjects\Tests\Web;

use PHPUnit\Framework\Attributes\DataProvider;
use ValueObjects\StringLiteral\StringLiteral;
use PHPUnit\Framework\TestCase;
use ValueObjects\Web\FragmentIdentifier;
use ValueObjects\Web\NullPortNumber;
use ValueObjects\Web\Path;
use ValueObjects\Web\PortNumber;
use ValueObjects\Web\QueryString;
use ValueObjects\Web\SchemeName;
use ValueObjects\Web\Url;
use ValueObjects\Web\Hostname;
use ValueObjects\ValueObjectInterface;

class UrlTest extends TestCase
{
    /** @var Url */
    protected $url;

    public function setUp(): void
    {
        $this->url = new Url(
            new SchemeName('http'),
            new StringLiteral('user'),
            new StringLiteral('pass'),
            new Hostname('foo.com'),
            new PortNumber(80),
            new Path('/bar'),
            new QueryString('?querystring'),
            new FragmentIdentifier('#fragmentidentifier')
        );
    }
    
    public static function fromNativeProviderValidUrls(){
        return [
            [ 'http://user:pass@foo.com:80/bar?querystring#fragmentidentifier' ],
            [ 'http://www.test.com' ],
            [ 'http://www.test.com/bar' ],
            [ 'http://www.test.com/?querystring' ],
            [ 'http://www.test.com/#fragmentidentifier' ]
        ];
    }

    #[DataProvider('fromNativeProviderValidUrls')]
    public static function testFromNativeWithValidUrl($nativeUrlString)
    {
        $fromNativeUrl = Url::fromNative($nativeUrlString);

        self::assertSame($nativeUrlString, $fromNativeUrl->__toString());
    }
    
    public static function fromNativeProviderInvalidUrls(){
        return [
            [ 'foo.com:80/bar?querystring#fragmentidentifier' ],
            [ 'www.test.com' ],
            [ 'notAUrl' ]
        ];
    }
    
    #[DataProvider('fromNativeProviderInvalidUrls')]
    public function testFromNativeWithInvalidUrl($nativeUrlString)
    {
        $this->expectException(\InvalidArgumentException::class);
    
        Url::fromNative($nativeUrlString);
    }

    public function testSameValueAs()
    {
        $url2 = new Url(
            new SchemeName('http'),
            new StringLiteral('user'),
            new StringLiteral('pass'),
            new Hostname('foo.com'),
            new PortNumber(80),
            new Path('/bar'),
            new QueryString('?querystring'),
            new FragmentIdentifier('#fragmentidentifier')
        );

        $url3 = new Url(
            new SchemeName('git+ssh'),
            new StringLiteral(''),
            new StringLiteral(''),
            new Hostname('github.com'),
            new NullPortNumber(),
            new Path('/nicolopignatelli/valueobjects'),
            new QueryString('?querystring'),
            new FragmentIdentifier('#fragmentidentifier')
        );

        $this->assertTrue($this->url->sameValueAs($url2));
        $this->assertTrue($url2->sameValueAs($this->url));
        $this->assertFalse($this->url->sameValueAs($url3));

        $mock = $this->getMockBuilder(ValueObjectInterface::class)
            ->getMock();
        $this->assertFalse($this->url->sameValueAs($mock));
    }

    public function testGetDomain()
    {
        $domain = new Hostname('foo.com');
        $this->assertTrue($this->url->getDomain()->sameValueAs($domain));
    }

    public function testGetFragmentIdentifier()
    {
        $fragment = new FragmentIdentifier('#fragmentidentifier');
        $this->assertTrue($this->url->getFragmentIdentifier()->sameValueAs($fragment));
    }

    public function testGetPassword()
    {
        $password = new StringLiteral('pass');
        $this->assertTrue($this->url->getPassword()->sameValueAs($password));
    }

    public function testGetPath()
    {
        $path = new Path('/bar');
        $this->assertTrue($this->url->getPath()->sameValueAs($path));
    }

    public function testGetPort()
    {
        $port = new PortNumber(80);
        $this->assertTrue($this->url->getPort()->sameValueAs($port));
    }

    public function testGetQueryString()
    {
        $queryString = new QueryString('?querystring');
        $this->assertTrue($this->url->getQueryString()->sameValueAs($queryString));
    }

    public function testGetScheme()
    {
        $scheme = new SchemeName('http');
        $this->assertTrue($this->url->getScheme()->sameValueAs($scheme));
    }

    public function testGetUser()
    {
        $user = new StringLiteral('user');
        $this->assertTrue($this->url->getUser()->sameValueAs($user));
    }

    public function testToString()
    {
        $this->assertSame('http://user:pass@foo.com:80/bar?querystring#fragmentidentifier', $this->url->__toString());
    }
    
    public function testJsonSerialize()
    {
        $this->assertSame('http://user:pass@foo.com:80/bar?querystring#fragmentidentifier', $this->url->jsonSerialize());
    }

    public function testAuthlessUrlToString()
    {
        $nativeUrlString = 'http://foo.com:80/bar?querystring#fragmentidentifier';
        $authlessUrl = new Url(
            new SchemeName('http'),
            new StringLiteral(''),
            new StringLiteral(''),
            new Hostname('foo.com'),
            new PortNumber(80),
            new Path('/bar'),
            new QueryString('?querystring'),
            new FragmentIdentifier('#fragmentidentifier')
        );
        $this->assertSame($nativeUrlString, $authlessUrl->__toString());
        $fromNativeUrl = Url::fromNative($nativeUrlString);
        $this->assertSame($nativeUrlString, Url::fromNative($authlessUrl)->__toString());
    }

    public function testNullPortUrlToString()
    {
        $nullPortUrl = new Url(
            new SchemeName('http'),
            new StringLiteral('user'),
            new StringLiteral(''),
            new Hostname('foo.com'),
            new NullPortNumber(),
            new Path('/bar'),
            new QueryString('?querystring'),
            new FragmentIdentifier('#fragmentidentifier')
        );
        $this->assertSame('http://user@foo.com/bar?querystring#fragmentidentifier', $nullPortUrl->__toString());
    }
}
