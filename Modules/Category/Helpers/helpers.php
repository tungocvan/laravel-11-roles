<?php

use Modules\Category\Models\WpTermTaxonomy;

function getTaxonomy($taxonomy)
    {
        $category = WpTermTaxonomy::where('taxonomy', $taxonomy)
        ->join('wp_terms', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
        ->select('wp_terms.name','wp_terms.slug', 'wp_terms.term_id', 'wp_term_taxonomy.parent', 'wp_term_taxonomy.description')
        ->get();
        return $category;
    }