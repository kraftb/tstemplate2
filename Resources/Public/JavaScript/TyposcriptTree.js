
/*
TYPO3.Components.Tree.TyposcriptTree = function(config) {
	var conf = Ext.apply({
		rootVisible: true,
  	}, config);
	TYPO3.Components.Tree.TyposcriptTree.superclass.constructor.call(this, conf);
};


Ext.extend(TYPO3.Components.Tree.TyposcriptTree, TYPO3.Components.Tree.StandardTree, {
	initComponent: function() {
		TYPO3.Components.Tree.TyposcriptTree.superclass.initComponent.call(this);
	},
});
*/

function initTyposcriptTree() {
	var treeTypoScriptObjectBrowser = new TYPO3.Components.Tree.StandardTree({
		id: "TypoScriptObjectBrowser",
		 showHeader: false,
		 rootVisible: false,
		 onChange: "alert('change');",
		 countSelectedNodes: 0,
		 width: 'auto',
		 /*
			 listeners: {
			 click: function(node, event) {
			 if (typeof(node.attributes.checked) == "boolean") {
			 node.attributes.checked = ! node.attributes.checked;
			 node.getUI().toggleCheck(node.attributes.checked);
			 }
			 },
			 dblclick: function(node, event) {
			 if (typeof(node.attributes.checked) == "boolean") {
			 node.attributes.checked = ! node.attributes.checked;
			 node.getUI().toggleCheck(node.attributes.checked);
			 }
			 },
			 checkchange: TYPO3.Components.Tree.TcaCheckChangeHandler,
			 collapsenode: function(node) {
			 if (node.id !== "root") {
			 top.TYPO3.Storage.Persistent.removeFromList("tcaTrees." + this.ucId, node.attributes.uid);
			 }
			 },
			 expandnode: function(node) {
			 if (node.id !== "root") {
			 top.TYPO3.Storage.Persistent.addToList("tcaTrees." + this.ucId, node.attributes.uid);
			 }
			 },
			 beforerender: function(treeCmp) {
		 // Check if that tree element is already rendered. It is appended on the first tceforms_inline call.
		 if (Ext.fly(treeCmp.getId())) {
		 return false;
		 }
		 }
		 },
		  */
		 tcaMaxItems: 0,
		 tcaSelectRecursiveAllowed: false,
		 tcaSelectRecursive: false,
		 tcaExclusiveKeys: "",
		 ucId: "TypoScriptObjectBrowser-Tree",
		 selModel: TYPO3.Components.Tree.EmptySelectionModel,
		 disabled: false
	});
	(function() {
		treeTypoScriptObjectBrowser.render("tree_TypoScriptObjectBrowser");
	}).defer(20);
}

