<?php

namespace Tests\Unit;

use App\Support\MockExamData;
use Tests\TestCase;

class MockExamDataTest extends TestCase
{
    public function test_each_subject_provides_seventy_valid_multiple_choice_questions(): void
    {
        foreach (MockExamData::subjects() as $subject => $metadata) {
            $questions = MockExamData::questions($subject);
            $ids = array_column($questions, 'id');
            $prompts = array_column($questions, 'prompt');

            $this->assertSame(70, count($questions), $metadata['title']);
            $this->assertSame(count($ids), count(array_unique($ids)), $metadata['title']);
            $this->assertSame(count($prompts), count(array_unique($prompts)), $metadata['title']);

            foreach ($questions as $question) {
                $this->assertCount(4, $question['options'], $question['id']);
                $this->assertSame(4, count(array_unique($question['options'])), $question['id']);
                $this->assertSame(
                    1,
                    array_count_values($question['options'])[$question['answer']] ?? 0,
                    $question['id'],
                );
            }
        }
    }
}
