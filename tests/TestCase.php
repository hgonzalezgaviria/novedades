<?php
use App\Models\User;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function testLogin()
    {
        $this->visit('/login')
            ->type('admin', 'username')
            ->type('123', 'password')
            ->press('login')
            ->seePageIs('/');
    }

    protected function validatePermissions($user, $url_array, $codeStatus=403, $text='Error 403: Forbidden')
    {
        $this->be($user); //You are now authenticated
        foreach ($url_array as $url) {
            dump('validatePermissions in '.$url);
            $this->actingAs($user)
                ->get($url)
                ->assertResponseStatus($codeStatus)
                ->see($text);
        }
    }

    protected function findUser($username)
    {
        return User::where('username',$username)->get()->first();
    }


}
