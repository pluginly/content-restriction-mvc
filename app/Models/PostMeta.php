<?php

namespace ContentRestriction\App\Models;

use ContentRestriction\WpMVC\App;
use ContentRestriction\WpMVC\Database\Eloquent\Model;
use ContentRestriction\WpMVC\Database\Resolver;

class PostMeta extends Model {
    public static function get_table_name():string {
        return 'postmeta';
    }

    public function resolver():Resolver {
        return App::$container->get( Resolver::class );
    }
}