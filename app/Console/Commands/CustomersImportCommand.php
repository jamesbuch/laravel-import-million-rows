<?php

namespace App\Console\Commands;

use App\Traits\ImportHelper;
use Illuminate\Console\Command;

use function Laravel\Prompts\select;

class CustomersImportCommand extends Command
{
    // Rules:
    // 1. MySQL
    // 2. 256MB Memory Limit
    // 3. No Queue
    use ImportHelper;

    protected $signature = 'import:customers';

    protected $description = 'Import customers from CSV file.';

    public function handleImport($filePath): void
    {
        $method = select(
            label: 'Which import method do you want to test?',
            options: [
                'import01BasicOneByOne' => '01 - Basic One By One',
                'import02CollectAndInsert' => '02 - Collect and Insert',
                'import03CollectAndChunk' => '03 - Collect and Chunk',
                'import04LazyCollection' => '04 - Lazy Collection',
                'import05LazyCollectionWithChunking' => '05 - Lazy Collection with Chunking',
                'import06LazyCollectionWithChunkingAndPdo' => '06 - Lazy Collection with Chunking and PDO',
                'import07ManualStreaming' => '07 - Manual Streaming',
                'import08ManualStreamingWithPdo' => '08 - Manual Streaming with PDO',
                'import09PDOPrepared' => '09 - PDO Prepared',
                'import10PDOPreparedChunked' => '10 - PDO Prepared Chunked',
                'import11Concurrent' => '11 - Concurrent',
                'import12LoadDataInfile' => '12 - PostgreSQL COPY (Fastest)',
            ]
        );

        $this->$method($filePath);
    }
}
