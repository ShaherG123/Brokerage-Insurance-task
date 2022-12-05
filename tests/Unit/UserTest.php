<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

    // public function __construct()
    // {
    //     $this->setUpFaker();
    // }
    /**
     * Correct Credentials email, password.
     *
     * @return void
     */
    public function testCorrectCredentialsTest()
    {
        $response = $this->call('POST', '/api/login', [
            'email' => 'mahmoud@sm.developer.com',
            'password' => 'mahmoud123456',
        ]);
        //dd($response->getContent());
        $this->assertEquals(201, $response->getStatusCode());
    }

    /**
     * Wrong Credentials email, password.
     *
     * @return void
     */
    public function testWrongCredentialsTest()
    {
        $response = $this->call('POST', '/api/login', [
            'email' => 'wrong@sm.com',
            'password' => 'wrong',
        ]);
        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * Wrong correct email, wrong password.
     *
     * @return void
     */
    public function testWrongPasswordTest()
    {
        $response = $this->call('POST', '/api/login', [
            'email' => 'mahmoud@sm.developer.com',
            'password' => 'wrong password',
        ]);
        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * Wrong wrong email, correct password.
     *
     * @return void
     */
    public function testWrongEmailTest()
    {
        $response = $this->call('POST', '/api/login', [
            'email' => 'mahmoud@sm.developer',
            'password' => 'mahmoud123456',
        ]);
        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * correct email, correct password. to check response body (personal inforamtion)
     *
     * @return void
     */
    public function testBodyInSuccessTest()
    {
        $response = $this->call('POST', '/api/login', [
            'email' => 'mahmoud@sm.developer.com',
            'password' => 'mahmoud123456',
        ]);

        // assertions for correct personal information
        $this->assertEquals('mahmoud', json_decode($response->getContent())->items->name);
        $this->assertEquals('mahmoud@sm.developer.com', json_decode($response->getContent())->items->email);
        $this->assertEquals('01124672698', json_decode($response->getContent())->items->phone);
        $this->assertEquals('male', json_decode($response->getContent())->items->gender);
        $this->assertEquals('admin', json_decode($response->getContent())->items->type);
    }
    /**
     * wrong email, wrong password. to check response body
     *
     * @return void
     */
    public function testBodyInErrorTest()
    {
        $response = $this->call('POST', '/api/login', [
            'email' => 'mahmoud@sm.developer',
            'password' => 'mahmoud123456',
        ]);
        // assertions for not authenticated message
        $this->assertEquals('You are not authenticated', json_decode($response->getContent())->message);
    }

    /**
     * send token in header. to check logout message and response code
     *
     * @return void
     */
    public function testLogoutSuccessTest()
    {
        $user = User::factory()->create();
        $response = $this->call('POST', '/api/login', [
            'email' => $user->email,
            'password' => '123456',
        ]);
        $token = json_decode($response->getContent())->meta->token;
        $response = $this->actingAs($user, 'api')->
            withHeader('Authorization', 'Bearer ' . $token)->json('post', '/api/logout');
        // assertions for not authenticated message
        $this->assertEquals('Successfully logged out', json_decode($response->getContent())->message);
        // assertions for success status code
        $this->assertEquals(201, $response->getStatusCode());
    }

    /**
     * send token in header. to check logout message and response code
     *
     * @return void
     */
    public function testLogoutErrorTest()
    {
        $token = 'Wrong token';
        $response = $this->postJson('/api/logout');
        // dd($response);
        // assertions for not authenticated status code
        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * Correct registration data (name, email, phone, password, password confirmation, gender).
     *
     * @return void
     */
    public function testCorrectRegisterTest()
    {
        $name = $this->faker->name();
        $email = $this->faker->email();
        $phone = '01' . $this->randomNumber(9);
        $response = $this->call('POST', '/api/register', [
            'name' => $name,
            'email' => $email,
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'phone' => $phone,
            'gender' => 'male',
        ]);
        // dd($response);
        // assertions for correct personal information
        $this->assertEquals($name, json_decode($response->getContent())->items->name);
        $this->assertEquals($email, json_decode($response->getContent())->items->email);
        $this->assertEquals($phone, json_decode($response->getContent())->items->phone);
        $this->assertEquals('male', json_decode($response->getContent())->items->gender);
        $this->assertEquals('user', json_decode($response->getContent())->items->type);
        $this->assertEquals(201, $response->getStatusCode());
    }

    /**
     * Wrong registration data (without required feilds).
     *
     * @return void
     */
    public function testWithoutRequiredFieldsRegisterTest()
    {

        $email = $this->faker->email();
        $phone = '01' . $this->randomNumber(9);
        $response = $this->call('POST', '/api/register', [
            'name' => '',
            'email' => '',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'phone' => '',
            'gender' => '',
        ]);
        // dd($response->getContent());
        $this->assertEquals("The given data was invalid.", json_decode($response->getContent())->message);
        $this->assertEquals(["The email field is required."], json_decode($response->getContent())->errors->email);
        $this->assertEquals(["The name field is required."], json_decode($response->getContent())->errors->name);
        $this->assertEquals(["The phone field is required."], json_decode($response->getContent())->errors->phone);
        $this->assertEquals(["The gender field is required."], json_decode($response->getContent())->errors->gender);
        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * Wrong registration data (with invalid data).
     *
     * @return void
     */
    public function testWithInvalidDataRegisterTest()
    {
        $email = $this->faker->email();
        $phone = '01' . $this->randomNumber(9);
        $response = $this->call('POST', '/api/register', [
            'name' => 'mahmoud',
            'email' => 'mahmoud',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'phone' => $phone,
            'gender' => 'null',
        ]);
        // dd($response->getContent());
        $this->assertEquals("The given data was invalid.", json_decode($response->getContent())->message);
        $this->assertEquals(["The email must be a valid email address."], json_decode($response->getContent())->errors->email);
        $this->assertEquals(["The selected gender is invalid."], json_decode($response->getContent())->errors->gender);
        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * Set new password with correct data.
     *
     * @return void
     */
    public function testSetNewPasswrodTest()
    {
        $user = User::factory()->create();
        $response = $this->call('POST', '/api/login', [
            'email' => $user->email,
            'password' => '123456',
        ]);

        $response = $this->call('POST', '/api/setnewpassword', [
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);
        // dd($response->getContent());
        $this->assertEquals("User password changed successfully", json_decode($response->getContent())->message);
        $this->assertEquals(201, $response->getStatusCode());
    }

    /**
     * Set new password with wrong data.
     *
     * @return void
     */
    public function testWrongSetNewPasswrodTest()
    {
        $user = User::factory()->create();
        $response = $this->call('POST', '/api/login', [
            'email' => $user->email,
            'password' => '123456',
        ]);
        $response = $this->call('POST', '/api/setnewpassword', [
            'password' => '12345678',
            'password_confirmation' => '123456789',
        ]);
        // dd($response->getContent());
        $this->assertEquals("The given data was invalid.", json_decode($response->getContent())->message);
        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * Set new password without data.
     *
     * @return void
     */
    public function testWithoutDataSetNewPasswrodTest()
    {
        $user = User::factory()->create();
        $response = $this->call('POST', '/api/login', [
            'email' => $user->email,
            'password' => '123456',
        ]);

        $response = $this->call('POST', '/api/setnewpassword', [
            'password' => '',
            'password_confirmation' => '',
        ]);
        // dd($response->getContent());
        $this->assertEquals("The given data was invalid.", json_decode($response->getContent())->message);
        $this->assertEquals(["The password field is required."], json_decode($response->getContent())->errors->password);
        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * Update user info with correct data.
     *
     * @return void
     */
    public function testUpdateInfoTest()
    {
        $user = User::factory()->create();
        $response = $this->call('POST', '/api/login', [
            'email' => $user->email,
            'password' => '123456',
        ]);

        $name = $this->faker->name();
        $email = $this->faker->email();
        $phone = '01' . $this->randomNumber(9);

        $response = $this->call('POST', '/api/updateInfo', [
            'name' => $name,
            'email' => $email,
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'phone' => $phone,
            'gender' => 'male',
        ]);
        // dd($response->getContent());
        $this->assertEquals("Successfully updated data", json_decode($response->getContent())->message);
        $this->assertEquals(201, $response->getStatusCode());
    }

    /**
     * Update user info with correct data(without password).
     *
     * @return void
     */
    public function testUpdateInfoWithoutPasswordTest()
    {
        $user = User::factory()->create();
        $response = $this->call('POST', '/api/login', [
            'email' => $user->email,
            'password' => '123456',
        ]);
        $name = $this->faker->name();
        $email = $this->faker->email();
        $phone = '01' . $this->randomNumber(9);

        $response = $this->call('POST', '/api/updateInfo', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'gender' => 'male',
        ]);
        // dd($response->getContent());
        $this->assertEquals("Successfully updated data", json_decode($response->getContent())->message);
        $this->assertEquals(201, $response->getStatusCode());
    }
    /**
     * Update user info with correct data(with wrong password confirmation ).
     *
     * @return void
     */
    public function testUpdateInfoWithPasswordWrongConfirmationTest()
    {
        $user = User::factory()->create();
        $response = $this->call('POST', '/api/login', [
            'email' => $user->email,
            'password' => '123456',
        ]);
        $name = $this->faker->name();
        $email = $this->faker->email();
        $phone = '01' . $this->randomNumber(9);

        $response = $this->call('POST', '/api/updateInfo', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => '12345678',
            'password_confirmation' => '123678',
            'gender' => 'male',
        ]);
       // dd($response);
        $this->assertEquals("The given data was invalid.", json_decode($response->getContent())->message);
        $this->assertEquals(["The password confirmation does not match."], json_decode($response->getContent())->errors->password);
        $this->assertEquals(422, $response->getStatusCode());
    }

    // Complementary functions
    private function randomNumber($length)
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }
}
