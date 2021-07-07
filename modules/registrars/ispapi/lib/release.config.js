const cfg = require("@hexonet/semantic-release-github-npm-config");
cfg.plugins = cfg.plugins.filter((plugin) => {
    return plugin !== "@semantic-release/npm"
});
module.exports = cfg;