<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_companies_store()
    {
       

        $response = $this->post('companies/store', [
            Company::create([
                'name' => 'test',
                'email'=> 'test@test.com',
                'website_url' => 'tyest.com',
                'logo_path' => 'companies/EDxzmXHQs3CsvkkI0HDnKqObVuiKtJWo0wvBOvcL.jpg'
            ])
        ]);

        $response->assertStatus(200);
       
    }

}
