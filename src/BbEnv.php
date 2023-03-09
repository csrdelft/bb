<?php

namespace CsrDelft\bb;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbEnv {
    /**
     * @var string One of default, light, preview, plain
     */
    public $mode = "default";
    public $quote_level = 0;
    public $nobold = false;
}
