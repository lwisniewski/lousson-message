<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 textwidth=75: *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Copyright (c) 2013, The Lousson Project                               *
 *                                                                       *
 * All rights reserved.                                                  *
 *                                                                       *
 * Redistribution and use in source and binary forms, with or without    *
 * modification, are permitted provided that the following conditions    *
 * are met:                                                              *
 *                                                                       *
 * 1) Redistributions of source code must retain the above copyright     *
 *    notice, this list of conditions and the following disclaimer.      *
 * 2) Redistributions in binary form must reproduce the above copyright  *
 *    notice, this list of conditions and the following disclaimer in    *
 *    the documentation and/or other materials provided with the         *
 *    distribution.                                                      *
 *                                                                       *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS   *
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT     *
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS     *
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE        *
 * COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,            *
 * INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES    *
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR    *
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)    *
 * HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,   *
 * STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)         *
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED   *
 * OF THE POSSIBILITY OF SUCH DAMAGE.                                    *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

/**
 *  Lousson\Message\AbstractMessageResolverTest class definition
 *
 *  @package    org.lousson.record
 *  @copyright  (c) 2013, The Lousson Project
 *  @license    http://opensource.org/licenses/bsd-license.php New BSD License
 *  @author     Mathias J. Hennig <mhennig at quirkies.org>
 *  @filesource
 */
namespace Lousson\Message;

/** Dependencies: */
use Lousson\Message\AnyMessageResolver;
use Lousson\Message\AbstractMessageTest;

/**
 *  An abstract test case for message resolvers
 *
 *  @since      lousson/Lousson_Message-0.1.0
 *  @package    org.lousson.record
 */
abstract class AbstractMessageResolverTest extends AbstractMessageTest
{
    /**
     *  Obtain a message resolver instance
     *
     *  The getMessageResolver() method is used to obtain the resolver
     *  instance to use in the tests.
     *
     *  @return \Lousson\Message\AnyMessageResolver
     *          A message resolver instance is returned on success
     */
    abstract public function getMessageResolver();

    /**
     *  Test the resolveHandler() method
     *
     *  The testResolveValidHandlerURI() method is a test case for the
     *  getMessageHandler() method in the AnyMessageResolver interface.
     *  It verifies that the implementation returns an instance of the
     *  AnyMessageHandler interface when invoked with a valid URI.
     *
     *  @param  string              $uri        The URI to resolve
     *
     *  @dataProvider               provideValidURIs
     *  @test
     *
     *  @throws \PHPUnit_Framework_AssertionFailedError
     *          Raised in case an assertion has failed
     *
     *  @throws \Exception
     *          Raised in case of an internal error
     */
    public function testResolveValidHandlerURI($uri)
    {
        $resolver = $this->getMessageResolver();
        $class = get_class($resolver);
        $handler = $resolver->resolveHandler($uri);
        $interface = "Lousson\\Message\\AnyMessageHandler";
        $isHandler = $this->isInstanceOf($interface);

        $this->assertThat(
            $handler, $this->logicalOr($isHandler, $this->isNull()),
            "The $class::resolveHandler() method must return an ".
            "instance of the message handler interface"
        );
    }

    /**
     *  Test the resolveHandler() method
     *
     *  The testResolveInvalidHandlerURI() method is a test case for the
     *  getMessageResolver() method in the AnyMessageResolver interface.
     *  It verfies that the implementation raises an exception in case the
     *  URI to resolve is invalid.
     *
     *  @param  string              $uri        The URI to resolve
     *
     *  @dataProvider               provideInvalidURIs
     *  @expectedException          Lousson\Message\AnyMessageException
     *  @test
     *
     *  @throws \Lousson\Message\AnyMessageException
     *          Raised in case the test is successful
     *
     *  @throws \Exception
     *          Raised in case of any error
     */
    public function testResolveInvalidHandlerURI($uri)
    {
        $this->testResolveValidHandlerURI($uri);
    }

    /**
     *  Test the resolveProvider() method
     *
     *  The testResolveValidProviderURI() method is a test case for the
     *  getMessageProvider() method in the AnyMessageResolver interface.
     *  It verifies that the implementation returns an instance of the
     *  AnyMessageProvider interface when invoked with a valid URI.
     *
     *  @param  string              $uri        The URI to resolve
     *
     *  @dataProvider               provideValidURIs
     *  @test
     *
     *  @throws \PHPUnit_Framework_AssertionFailedError
     *          Raised in case an assertion has failed
     *
     *  @throws \Exception
     *          Raised in case of an internal error
     */
    public function testResolveValidProviderURI($uri)
    {
        $resolver = $this->getMessageResolver();
        $class = get_class($resolver);
        $provider = $resolver->resolveProvider($uri);
        $interface = "Lousson\\Message\\AnyMessageProvider";
        $isProvider = $this->isInstanceOf($interface);

        $this->assertThat(
            $provider, $this->logicalOr($isProvider, $this->isNull()),
            "The $class::resolveProvider() method must return an ".
            "instance of the message provider interface"
        );
    }

    /**
     *  Test the resolveProvider() method
     *
     *  The testResolveInvalidProviderURI() method is a test case for the
     *  getMessageResolver() method in the AnyMessageResolver interface.
     *  It verfies that the implementation raises an exception in case the
     *  URI to resolve is invalid.
     *
     *  @param  string              $uri        The URI to resolve
     *
     *  @dataProvider               provideInvalidURIs
     *  @expectedException          Lousson\Message\AnyMessageException
     *  @test
     *
     *  @throws \Lousson\Message\AnyMessageException
     *          Raised in case the test is successful
     *
     *  @throws \Exception
     *          Raised in case of any error
     */
    public function testResolveInvalidProviderURI($uri)
    {
        $this->testResolveValidProviderURI($uri);
    }
}

