
plugin.tx_simpleinstagram_instafeed {
    view {
        templateRootPaths.0 = EXT:simple_instagram/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_simpleinstagram_instafeed.view.templateRootPath}
        partialRootPaths.0 = EXT:simple_instagram/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_simpleinstagram_instafeed.view.partialRootPath}
        layoutRootPaths.0 = EXT:simple_instagram/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_simpleinstagram_instafeed.view.layoutRootPath}
    }
    settings {
        username = {$plugin.tx_simpleinstagram_instafeed.settings.username}
        password = {$plugin.tx_simpleinstagram_instafeed.settings.password}
        instaAccount = {$plugin.tx_simpleinstagram_instafeed.settings.instaAccount}
    }
}
