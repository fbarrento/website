import Prism from "prismjs";

// Include a theme:
import "prismjs/themes/prism-okaidia.css";

// Include some plugins:
import "prismjs/plugins/autoloader/prism-autoloader";
import "prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard";
import "prismjs/plugins/highlight-keywords/prism-highlight-keywords";
import "prismjs/plugins/normalize-whitespace/prism-normalize-whitespace";
import "prismjs/plugins/show-language/prism-show-language";

// Include additional languages:
import "prismjs/components/prism-bash";
import "prismjs/components/prism-powershell";
import "prismjs/components/prism-toml";
import "prismjs/components/prism-yaml";

// Set vue SFC to markdown
Prism.languages.vue = Prism.languages.markup;

export default Prism;