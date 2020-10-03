<?php

namespace Modules\Example\Tests\Unit;

use Modules\Example\Services\Paginator;
use Tests\TestCase;

class PaginatorTest extends TestCase
{
    public function testPagination()
    {
        $result = Paginator::paginate(1, 20, 18);
        $this->assertCount(1, $result);
        $this->assertEquals(1, $result[0][0]);

        $result = Paginator::paginate(1, 20, 19);
        $this->assertCount(1, $result);
        $this->assertEquals(1, $result[0][0]);

        $result = Paginator::paginate(1, 20, 20);
        $this->assertCount(1, $result);
        $this->assertEquals(1, $result[0][0]);

        $result = Paginator::paginate(1, 20, 21);
        $this->assertCount(1, $result);
        $this->assertCount(2, $result[0]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(2, $result[0][1]);

        $result = Paginator::paginate(2, 20, 21);
        $this->assertCount(1, $result);
        $this->assertCount(2, $result[0]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(2, $result[0][1]);

        $result = Paginator::paginate(3, 20, 21);
        $this->assertCount(1, $result);
        $this->assertCount(2, $result[0]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(2, $result[0][1]);

        $result = Paginator::paginate(1, 20, 41);
        $this->assertCount(1, $result);
        $this->assertCount(3, $result[0]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(2, $result[0][1]);
        $this->assertEquals(3, $result[0][2]);

        $result = Paginator::paginate(2, 20, 41);
        $this->assertCount(1, $result);
        $this->assertCount(3, $result[0]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(2, $result[0][1]);
        $this->assertEquals(3, $result[0][2]);

        $result = Paginator::paginate(3, 20, 41);
        $this->assertCount(1, $result);
        $this->assertCount(3, $result[0]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(2, $result[0][1]);
        $this->assertEquals(3, $result[0][2]);

        $result = Paginator::paginate(1, 20, 61);
        $this->assertCount(2, $result);
        $this->assertCount(2, $result[0]);
        $this->assertCount(1, $result[1]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(2, $result[0][1]);
        $this->assertEquals(4, $result[1][0]);

        $result = Paginator::paginate(2, 20, 61);
        $this->assertCount(1, $result);
        $this->assertCount(4, $result[0]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(2, $result[0][1]);
        $this->assertEquals(3, $result[0][2]);
        $this->assertEquals(4, $result[0][3]);

        $result = Paginator::paginate(3, 20, 61);
        $this->assertCount(1, $result);
        $this->assertCount(4, $result[0]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(2, $result[0][1]);
        $this->assertEquals(3, $result[0][2]);
        $this->assertEquals(4, $result[0][3]);

        $result = Paginator::paginate(4, 20, 61);
        $this->assertCount(2, $result);
        $this->assertCount(1, $result[0]);
        $this->assertCount(2, $result[1]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(3, $result[1][0]);
        $this->assertEquals(4, $result[1][1]);

        $result = Paginator::paginate(2, 20, 81);
        $this->assertCount(2, $result);
        $this->assertCount(3, $result[0]);
        $this->assertCount(1, $result[1]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(2, $result[0][1]);
        $this->assertEquals(3, $result[0][2]);
        $this->assertEquals(5, $result[1][0]);

        $result = Paginator::paginate(3, 20, 81);
        $this->assertCount(1, $result);
        $this->assertCount(5, $result[0]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(2, $result[0][1]);
        $this->assertEquals(3, $result[0][2]);
        $this->assertEquals(4, $result[0][3]);
        $this->assertEquals(5, $result[0][4]);

        $result = Paginator::paginate(4, 20, 81);
        $this->assertCount(2, $result);
        $this->assertCount(1, $result[0]);
        $this->assertCount(3, $result[1]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(3, $result[1][0]);
        $this->assertEquals(4, $result[1][1]);
        $this->assertEquals(5, $result[1][2]);

        $result = Paginator::paginate(5, 20, 81);
        $this->assertCount(2, $result);
        $this->assertCount(1, $result[0]);
        $this->assertCount(2, $result[1]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(4, $result[1][0]);
        $this->assertEquals(5, $result[1][1]);

        $result = Paginator::paginate(3, 20, 101);
        $this->assertCount(2, $result);
        $this->assertCount(4, $result[0]);
        $this->assertCount(1, $result[1]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(2, $result[0][1]);
        $this->assertEquals(3, $result[0][2]);
        $this->assertEquals(4, $result[0][3]);
        $this->assertEquals(6, $result[1][0]);

        $result = Paginator::paginate(4, 20, 101);
        $this->assertCount(2, $result);
        $this->assertCount(1, $result[0]);
        $this->assertCount(4, $result[1]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(3, $result[1][0]);
        $this->assertEquals(4, $result[1][1]);
        $this->assertEquals(5, $result[1][2]);
        $this->assertEquals(6, $result[1][3]);

        $result = Paginator::paginate(5, 20, 101);
        $this->assertCount(2, $result);
        $this->assertCount(1, $result[0]);
        $this->assertCount(3, $result[1]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(4, $result[1][0]);
        $this->assertEquals(5, $result[1][1]);
        $this->assertEquals(6, $result[1][2]);

        $result = Paginator::paginate(6, 20, 101);
        $this->assertCount(2, $result);
        $this->assertCount(1, $result[0]);
        $this->assertCount(2, $result[1]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(5, $result[1][0]);
        $this->assertEquals(6, $result[1][1]);

        $result = Paginator::paginate(4, 20, 121);
        $this->assertCount(3, $result);
        $this->assertCount(1, $result[0]);
        $this->assertCount(3, $result[1]);
        $this->assertCount(1, $result[2]);
        $this->assertEquals(1, $result[0][0]);
        $this->assertEquals(3, $result[1][0]);
        $this->assertEquals(4, $result[1][1]);
        $this->assertEquals(5, $result[1][2]);
        $this->assertEquals(7, $result[2][0]);
    }
}
