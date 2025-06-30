<?php

namespace App\Models;
/**
 * User modelo que representa un usuario en el sistema.
 * Este modelo define las propiedades de un usuario y su estructura.
 * @package App\Models
 * @author Joc Duarte
 */

class User
{
    public int $id;
    public string $email;
    public string $name;
    public string $password;
}
