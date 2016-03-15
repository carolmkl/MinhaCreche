<?php
    
    class Acesso extends SplEnum{
        const __default = self:: RESPONSAVEL;
        
        const RESPONSAVEL = 1;
        const PEDAGOGO = 2;
        const SECRETARIO = 3;
        const DIRETOR = 4;
    }
    
?>