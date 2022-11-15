<?php

namespace Storage;

use Exception;
use Google\Client;
use Google\Service\Drive;
use Traits\Models\TConstruct;

class FileService
{
    use TConstruct;

    private string $id;
    private string $name;
    private string $type;
    private string $tmp_name;

    public function __construct()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=upload-367301-bea22986f98d.json');
        call_user_func_array([$this, 'construct'], func_get_args());
    }

    public function __construct2(string $id, string $name): void
    {
        $this -> id = $id;
        $this -> name = $name;
    }

    public function __construct3(string $name, string $type, string $tmp_name): void
    {
        $this -> name = $name;
        $this -> type = $type;
        $this -> tmp_name = $tmp_name;
    }

    public function __construct4(string $id, string $name, string $type, string $tmp_name): void
    {
        $this -> id = $id;
        $this -> __construct3($name, $type, $tmp_name);
    }

    public function upload() :array|string
    {
        try {
            $client = new Client();
            $client -> useApplicationDefaultCredentials();
            $client -> addScope(Drive::DRIVE_FILE);
            $driveService = new Drive($client);
            $fileMetadata = new Drive\DriveFile([
                'name' => $this -> name,
                'parents' => ['1NXtwqu1tQtWAOLe9bjOq1miUIdML7ARV'],
                'mimeType' => $this -> type
            ]);
            $content = file_get_contents($this -> tmp_name);
            $file = $driveService -> files -> create($fileMetadata, [
                'data' => $content,
                'mimeType' => $this -> type,
                'uploadType' => 'resumable',
                'fields' => 'id,name',
            ]);
            return ['id' => $file -> id, 'name' => $file -> name];
        } catch (Exception $e) {
            return $e -> getMessage();
        }
    }

    public function update(): array|string
    {
        try {
            $client = new Client();
            $client -> useApplicationDefaultCredentials();
            $client -> addScope(Drive::DRIVE_FILE);
            $driveService = new Drive($client);
            $fileMetadata = new Drive\DriveFile([
                'name' => $this -> name,
                'mimeType' => $this -> type
            ]);
            $content = file_get_contents($this -> tmp_name);
            $updated_file = $driveService -> files -> update($this -> id, $fileMetadata, [
                'data' => $content,
                'mimeType' => $this -> type,
                'fields' => 'id,name',
            ]);
            return ['id' => $updated_file -> id, 'name' => $updated_file -> name];
        } catch (Exception $e) {
            return $e -> getMessage();
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this -> id;
    }

    /**
     * @return string
     */
    public function getName() :string
    {
        return $this -> name;
    }
}
