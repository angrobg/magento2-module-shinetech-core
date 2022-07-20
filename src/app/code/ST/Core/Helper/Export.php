<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ST\Core\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Export extends AbstractHelper
{
    /**
     * @var \Magento\Framework\Filesystem\DriverInterface
     */
    protected $filesystemDriver;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\Filesystem\DriverInterface $filesystemDriver
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context         $context,
        \Magento\Framework\Filesystem\DriverInterface $filesystemDriver
    )
    {
        $this->filesystemDriver = $filesystemDriver;
        parent::__construct($context);
    }

    /**
     * Export data to CSV file
     * @param string $filePath
     * @param array $data
     * @param array $header
     * @return string
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function toCsvFile(string $filePath, array $data, array $header = []): string
    {
        $exportHandle = $this->filesystemDriver->fileOpen($filePath, "w");
        // phpcs:ignore Magento2.Functions.DiscouragedFunction.Discouraged
        fprintf($exportHandle, chr(0xEF) . chr(0xBB) . chr(0xBF));

        // Write header
        if ($header) {
            $this->filesystemDriver->filePutCsv($exportHandle, $header);
        }

        // Write row data
        foreach ($data as $item) {
            $this->filesystemDriver->filePutCsv($exportHandle, $item);
        }

        $this->filesystemDriver->fileClose($exportHandle);

        return $filePath;
    }
}

