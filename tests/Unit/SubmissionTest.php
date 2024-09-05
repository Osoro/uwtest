<?php

namespace Tests\Unit;

use App\Http\Requests\SubmissionPostRequest;
use App\Jobs\ProcessSubmissionsJob;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    /**
     * @test
     */
    public function it_validation_with_valid_data()
    {
        $request = new SubmissionPostRequest();
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'test',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->fails(), 'The validation should pass with valid data.');
    }

    /**
     * @test
     */
    public function it_validation_with_invalid_data()
    {
        $request = new SubmissionPostRequest();
        $data = [
            'name' => 'John Doe',
            'email' => 'not_email',
        ];

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails(), 'The validation should fail with invalid data.');
        $this->assertContains('The message field is required.', $validator->errors()->all());
        $this->assertContains('The email field must be a valid email address.', $validator->errors()->all());
    }

    /**
     * @test
     */
    public function it_dispatches_job()
    {
        Queue::fake();

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'test',
        ];

        dispatch(new ProcessSubmissionsJob($data));

        Queue::assertPushed(ProcessSubmissionsJob::class);
    }
}
