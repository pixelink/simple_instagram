
plugin.tx_simpleinstagram_instafeed {
    view {
        # cat=plugin.tx_simpleinstagram_instafeed/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:simple_instagram/Resources/Private/Templates/
        # cat=plugin.tx_simpleinstagram_instafeed/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:simple_instagram/Resources/Private/Partials/
        # cat=plugin.tx_simpleinstagram_instafeed/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:simple_instagram/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_simpleinstagram_instafeed//a; type=string; label=Default storage PID
        storagePid =
    }
}
