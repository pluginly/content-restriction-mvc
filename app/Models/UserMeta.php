<?php

namespace ContentRestriction\App\Models;

use ContentRestriction\WpMVC\App;
use ContentRestriction\WpMVC\Database\Eloquent\Model;
use ContentRestriction\WpMVC\Database\Resolver;

class UserMeta extends Model {
    public static function get_table_name():string {
        return 'usermeta';
    }

    public function resolver():Resolver {
        return App::$container->get( Resolver::class );
    }
}