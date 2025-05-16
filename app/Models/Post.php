<?php

namespace ContentRestriction\App\Models;

use ContentRestriction\WpMVC\App;
use ContentRestriction\WpMVC\Database\Eloquent\Model;
use ContentRestriction\WpMVC\Database\Eloquent\Relations\HasMany;
use ContentRestriction\WpMVC\Database\Resolver;

class Post extends Model {
    public static function get_table_name():string {
        return 'posts';
    }

    public function meta(): HasMany {
        return $this->has_many( PostMeta::class, 'post_id', 'ID' );
    }

    public function resolver():Resolver {
        return App::$container->get( Resolver::class );
    }
}