import SetDataTransferPlugin from './set-data-transfer-plugin/set-data-transfer-plugin.plugin';

const PluginManager = window.PluginManager;
PluginManager.register('SetDataTransferPlugin', SetDataTransferPlugin, '[data-set-data-transfer-plugin]');

// Necessary for the webpack hot module reloading server
if (module.hot) {
    module.hot.accept();
}
