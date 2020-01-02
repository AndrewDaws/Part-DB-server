<?php
/**
 * This file is part of Part-DB (https://github.com/Part-DB/Part-DB-symfony).
 *
 * Copyright (C) 2019 Jan Böhmer (https://github.com/jbtronics)
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA
 */

declare(strict_types=1);

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * All subclasses of this class have an attribute "name".
 *
 * @ORM\MappedSuperclass(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
abstract class NamedDBElement extends DBElement
{
    use TimestampTrait;

    /**
     * @var string The name of this element.
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Groups({"simple", "extended", "full"})
     */
    protected $name = '';

    /********************************************************************************
     *
     *   Getters
     *
     *********************************************************************************/

    /**
     * Get the name of this element.
     *
     * @return string the name of this element
     */
    public function getName(): string
    {
        return $this->name;
    }

    /********************************************************************************
     *
     *   Setters
     *
     *********************************************************************************/

    /**
     * Change the name of this element.
     *
     * @param string $new_name the new name
     *
     * @return self
     */
    public function setName(string $new_name): self
    {
        $this->name = $new_name;

        return $this;
    }

    /******************************************************************************
     *
     * Helpers
     *
     ******************************************************************************/

    public function __toString()
    {
        return $this->getName();
    }
}
