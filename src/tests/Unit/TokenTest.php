<?php

namespace Tiketux\Token\Tests\Unit;

use Tiketux\Token\Tests\Unit\PassportTestCase;
use Tiketux\Token\Models\Token;

class TokenTest extends PassportTestCase
{
  public $baseUrl   = 'http://127.0.0.1';
  public function testGetToken()
  {
    $obj = new Token;
    $response = $obj->getToken();
    
    $this->assertDatabaseHas('tbl_token', [
      "id"            => $response->id,
      "group_name"    => $response->group_name,
      "token"         => $response->token
    ]);
  }
}
