const SioriSelector = {
    "eventTriggerSelectorGenerate": function(elementName,eventName){ return `[data-siori-${elementName}="${eventName}"]`},
    "componentSelectorGenerate": function(componentName){ return `[data-siori-component="${componentName}"]`}
};
