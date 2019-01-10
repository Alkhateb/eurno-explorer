<?php
class Submenu {
    private $submenu_page;
    public function __construct( $submenu_page ) {
        $this->submenu_page = $submenu_page;
    }
    public function init() {
         add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
    }
    public function add_menu_page() {
    add_menu_page(
        'Eurno Explorer Admin Page',
        'Eurno Explorer',
        'manage_options',
        '/eurno-explorer.php',
        array( $this->submenu_page, 'render' ),
        'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAABPBJREFUeJx1lA1Q03UYx39M7WUnnjjN9JAoDM0ky+rUvLLLusLjLRHU8AUjTEFR9DCQQSrvjBFjbDDG2zbH3tiYhEiCDBQQUKEzPcTQnPkSmqigDBnj229/hbuwnt1zu/vv/3z2fb6/5/cQMi5wjrA7G1w8CquW7MquWqrgGj3Ne3SBj2JUoYNc1dY7mdqNR3N1AQmna95e0dfKnj6+fjxsUnXVR0FCfUB5sGaDZfHhELgqt8CZfi+URcO9IAHzhCL4SNJsaarQM0qjZzStmfp/sKl11e9F+ovzHnwoUIEjyIJjQTheKwuBC00i82HyJVkAOMXbsCinCD4i2ZBY5ye2np3g8ZwyO2xvSWyXa3INpiRVYOKhCmw+9gu8TiTi+9PiMaA9HWR+mCLdBZcMDTZKBPcEmjXSkXMOnDHPjtE2vcXCB265PJCi9SDFa8CS+SOuXYXC32vQevcyYtrl+OYUH69qNz8FF60FkQbDKV2J5ZlqW6HeN8PcOHMO6ax38cjRbTDM5xnwYlY68zJL7ov3K/dA1l2H4REbRqPfakFsx2G46yNABAdAMtPAzuJhbmotYhWR16qOLvMnJQafXaHSVMuMgyfhkFLIAN8yhqPlbhee2KzoengTmqstqDWb0Wt5gsfWQRi7uzE7/STIfpqH9JjKl2KZMB/Z2iANydUFKZZklIMdXw/yUyIcS9di62kRBoaf4OHQY+phAhaok/FBXjMS682M0r8HrPAsuYAJ3EYQbi0m8UR4XSAFV7HDTPbLd5tnJTz9J5IXzrRac+tXplDYWQlXfSiWGvgINlwEv/EGRp61r+jowbzMs1TlKSbdkhsQIM4GiZFHPXJPaQCJqwUR7cXH1dFov3eVKSozN0F0qQpNd7owYLVS2Aiu9/Wj7c8+JJquw41/Zgw4O6EBn2WVgMTK91k8Rv1ILsHSqig09nSOHcSgbQiX+24h//Jx7GiVwOuIChGVVyBovonFoo4xoEviSXwhUFBhij09jEJuHUhqPtzLt0N2xcTAbFTR9pZcrDweBzfDVkxWBuJTgxRtN/pxtdfC+DgKdKa2eQvzaJe6zZUeadWYGEt/SM/BBLkfvqw5gLuDfQw09Tc9A7M/n6YOgo7aYA9Zew/cn3nIorXOVGFk8b77pFC/5tDXojybYzxtOUlOB3YdZmmDYbzeypz07YFepl37UMe0K5hn9y1DWKfuBPvHJgbIjjsFuyi++tt60la74JMsTWjb3OQTeIH71EciisJ8Yxh4Fw1M2/YYYT6gft7E3hYtHHkaegAmOFAgh87wzqKD/eojX20n9hVUVuH5g5dQOTTtAAXG0nlMlcChxJ+OzHeI61DS025Gd/9tNPx1AZprjXDWhdIRC2PemxxvV1eJTM2G8vN1bywa2zSSMj9xYK7gnv3GTDxYwcwkyQ9h7rX99nx+PB672woQ0pzDqGfJfMHO34lVQqUlQRluutU0/c1/bZzhs6yFMsPqfO8c9bBLogkvpxeAlVLMzKYdOlOziYHO1G6CU+l6zFBswrtF+5BUGm66VD8ngIpiPbcTR84RTukRX16KKvKP5Zl6uKfUg5P8M17hF8JJEg2OLBjzlWFYLItChHZLv9joY6DK5v4nbDToCnKuq162WqIP0iSVRlwLFAvgk1OMlXkZWCUPA1e/vldY4W3SVK7Ydt7k+s74+n8AdKGSkIlRjNcAAAAASUVORK5CYII=',
      6
        );
    add_submenu_page(
      '/eurno-explorer.php',
      'Enumivo Settings',
      'Enumivo',
      'manage_options',
      'eurno-explorer/enumivo.php',
      array( $this->submenu_page, 'enu_render' )
    );
    add_submenu_page(
      '/eurno-explorer.php',
      'EOS Settings',
      'EOS',
      'manage_options',
      'eurno-explorer/eos.php',
      array( $this->submenu_page, 'eos_render' )
    );
    add_submenu_page(
      '/eurno-explorer.php',
      'Telos Settings',
      'Telos',
      'manage_options',
      'eurno-explorer/telos.php',
      array( $this->submenu_page, 'tlos_render' )
    );
  }
}
?>
