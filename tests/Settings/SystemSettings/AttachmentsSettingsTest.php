<?php
/*
 * This file is part of Part-DB (https://github.com/Part-DB/Part-DB-symfony).
 *
 *  Copyright (C) 2019 - 2026 Jan Böhmer (https://github.com/jbtronics)
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published
 *  by the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace App\Tests\Settings\SystemSettings;

use App\Settings\SystemSettings\AttachmentsSettings;
use App\Tests\SettingsTestHelper;
use PHPUnit\Framework\TestCase;

class AttachmentsSettingsTest extends TestCase
{

    public function testGetMaxFileSizeInMegabytes(): void
    {
        $settings = SettingsTestHelper::createSettingsDummy(AttachmentsSettings::class);

        $settings->maxFileSize = '100M';
        $this->assertEquals(100, $settings->getMaxFileSizeInMegabytes());

        $settings->maxFileSize = '1G';
        $this->assertEquals(1024, $settings->getMaxFileSizeInMegabytes());

        //We round up to the next megabyte if the file size is smaller than 1 MB
        $settings->maxFileSize = '500K';
        $this->assertEquals(1, $settings->getMaxFileSizeInMegabytes());

        $settings->maxFileSize = '13.5M';
        $this->assertEquals(13, $settings->getMaxFileSizeInMegabytes());
    }
}
