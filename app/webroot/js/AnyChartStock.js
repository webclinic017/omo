if (typeof AnyChartStock == "undefined") {

var AnyChartStock = function() {
	this.constructor(arguments);
};

AnyChartStock.VERSION = "1.9.0 Revision #9317";

AnyChartStock.utils = {};
AnyChartStock.utils.hasProp = function(target) { return typeof target != "undefined"; };
AnyChartStock.utils.push = function(arr, item) { arr[arr.length] = item; };

//array indexof ie fix
if(!Array.prototype.indexOf) {
	Array.prototype.indexOf = function(obj){
		for(var i=0; i<this.length; i++){
			if(this[i]==obj) return i;
		}
		return -1;
	};
}

//--------------------------------------------------------------------------------------
//browser and os detection
//--------------------------------------------------------------------------------------

var tmpUa = (navigator && navigator.userAgent) ? navigator.userAgent.toLowerCase() : null;
var tmpUp = (navigator && navigator.platform) ? navigator.platform.toLowerCase() : null;

AnyChartStock.platform = {};
AnyChartStock.platform.isWin = tmpUp ? /win/.test(tmpUp) : /win/.test(tmpUa);
AnyChartStock.platform.isMac = !AnyChartStock.platform.isWin && (tmpUp ? /mac/.test(tmpUp) : /mac/.test(tmpUa));
AnyChartStock.platform.hasDom = AnyChartStock.utils.hasProp(document.getElementById) && AnyChartStock.utils.hasProp(document.getElementsByTagName) && AnyChartStock.utils.hasProp(document.createElement);
AnyChartStock.platform.webKit = /webkit/.test(tmpUa) ? parseFloat(tmpUa.replace(/^.*webkit\/(\d+(\.\d+)?).*$/, "$1")) : false;
AnyChartStock.platform.isIE = ! +"\v1";
AnyChartStock.platform.isFirefox = /firefox/.test(tmpUa);
AnyChartStock.platform.isOpera = /opera/.test(tmpUa);

AnyChartStock.platform.protocol = location.protocol == "https:" ? "https:" : "http:";

//--------------------------------------------------------------------------------------
//Flash Player version
//--------------------------------------------------------------------------------------
AnyChartStock.platform.flashPlayerVersion = [0, 0, 0];
if (AnyChartStock.utils.hasProp(navigator.plugins) && typeof navigator.plugins["Shockwave Flash"] == "object") {
	var d = navigator.plugins["Shockwave Flash"].description;
	if (d && !(AnyChartStock.utils.hasProp(navigator.mimeTypes) && navigator.mimeTypes["application/x-shockwave-flash"] && !navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin)) {
		AnyChartStock.platform.isIE = false; // cascaded feature detection for Internet Explorer
		d = d.replace(/^.*\s+(\S+\s+\S+$)/, "$1");
		AnyChartStock.platform.flashPlayerVersion[0] = parseInt(d.replace(/^(.*)\..*$/, "$1"), 10);
		AnyChartStock.platform.flashPlayerVersion[1] = parseInt(d.replace(/^.*\.(.*)\s.*$/, "$1"), 10);
		AnyChartStock.platform.flashPlayerVersion[2] = /[a-zA-Z]/.test(d) ? parseInt(d.replace(/^.*[a-zA-Z]+(.*)$/, "$1"), 10) : 0;
	}
} else if (typeof window.ActiveXObject != "undefined") {
	try {
		var a = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
		if (a) { // a will return null when ActiveX is disabled
			var d = a.GetVariable("$version");
			if (d) {
				AnyChartStock.platform.isIE = true; // cascaded feature detection for Internet Explorer
				d = d.split(" ")[1].split(",");
				AnyChartStock.platform.flashPlayerVersion = [parseInt(d[0], 10), parseInt(d[1], 10), parseInt(d[2], 10)];
			}
		}
	}
	catch (e) { }
}
AnyChartStock.platform.hasRequiredVersion = AnyChartStock.platform.flashPlayerVersion != null && Number(AnyChartStock.platform.flashPlayerVersion[0]) >= 9;
AnyChartStock.platform.needFormFix = AnyChartStock.platform.hasRequiredVersion && AnyChartStock.platform.isIE && AnyChartStock.platform.isWin;
if (AnyChartStock.platform.needFormFix) {
	//check player version
	AnyChartStock.platform.needFormFix = Number(AnyChartStock.platform.flashPlayerVersion[0]) == 9;
	AnyChartStock.platform.needFormFix = AnyChartStock.platform.needFormFix && Number(AnyChartStock.platform.flashPlayerVersion[1]) == 0;
	AnyChartStock.platform.needFormFix = AnyChartStock.platform.needFormFix && Number(AnyChartStock.platform.flashPlayerVersion[2]) < 115;
}
//--------------------------------------------------------------------------------------
//Event listeners
//--------------------------------------------------------------------------------------
AnyChartStock.utils.addGlobalEventListener = function(event, fn) {
	if (AnyChartStock.utils.hasProp(window.addEventListener)) window.addEventListener(event, fn, false);
	else if (AnyChartStock.utils.hasProp(document.addEventListener)) document.addEventListener(event, fn, false);
	else if (AnyChartStock.utils.hasProp(window.attachEvent)) AnyChartStock.utils.attachEvent(window, "on" + event, fn);
	else if (typeof window["on" + event] == "function") {
		var fnOld = window["on" + event];
		window["on" + event] = function() {
			fnOld();
			fn();
		};
	} else win["on" + event] = fn;
};
AnyChartStock.utils.listeners = [];
AnyChartStock.utils.attachEvent = function(target, event, fn) {
	target.attachEvent(event, fn);
	AnyChartStock.utils.push(AnyChartStock.utils.listeners, [target, event, fn]);
};

//--------------------------------------------------------------------------------------
//DomLoad function
//--------------------------------------------------------------------------------------
AnyChartStock.utils.isDomLoaded = false;
AnyChartStock.utils.domLoadListeners = [];
AnyChartStock.utils.addDomLoadEventListener = function(fn) {
	if (AnyChartStock.utils.isDomLoaded) fn();
	else AnyChartStock.utils.push(AnyChartStock.utils.domLoadListeners, fn);
};
AnyChartStock.utils.execDomLoadListeners = function() {
	if (AnyChartStock.utils.isDomLoaded) return;
	try { var t = document.getElementsByTagName("body")[0].appendChild(document.createElement("span")); t.parentNode.removeChild(t); } catch (e) { return; }

	AnyChartStock.utils.isDomLoaded = true;

	var len = AnyChartStock.utils.domLoadListeners.length;
	for (var i = 0; i < len; i++)
		AnyChartStock.utils.domLoadListeners[i]();
};
AnyChartStock.utils.registerDomLoad = function() {
	if (!AnyChartStock.platform.hasDom) return;
	if (AnyChartStock.utils.hasProp(document.readyState) && (document.readyState == "complete" || document.getElementsByTagName("body")[0] || document.body))
		AnyChartStock.utils.execDomLoadListeners();

	if (!AnyChartStock.utils.isDomLoaded) {
		if (AnyChartStock.utils.hasProp(document.addEventListener))
			document.addEventListener("DOMContentLoaded", AnyChartStock.utils.execDomLoadListeners, false);

		if (AnyChartStock.platform.isIE && AnyChartStock.platform.isWin) {
			document.attachEvent("onreadystatechange", function() {
				if (document.readyState == "complete") {
					document.detachEvent("onreadystatechange", arguments.callee);
					AnyChartStock.utils.execDomLoadListeners();
				}
			});

			if (window == top) {
				(function() {
					if (AnyChartStock.utils.isDomLoaded) { return; }
					try { document.documentElement.doScroll("left"); } catch (e) {
						setTimeout(arguments.callee, 0);
						return;
					}
					AnyChartStock.utils.execDomLoadListeners();
				})();
			}
		}
		if (AnyChartStock.platform.webKit) {
			(function() {
				if (AnyChartStock.utils.isDomLoaded) { return; }
				if (!/loaded|complete/.test(document.readyState)) {
					setTimeout(arguments.callee, 0);
					return;
				}
				AnyChartStock.utils.execDomLoadListeners();
			})();
		}
		AnyChartStock.utils.addGlobalEventListener("load", AnyChartStock.utils.execDomLoadListeners);
	}
};

//--------------------------------------------------------------------------------------
//Events calling
//--------------------------------------------------------------------------------------
AnyChartStock.dispatchEvent = function(chartId, eventObj) {
	if (chartId == null || eventObj == null) return;
	if (AnyChartStock.chartsMap && AnyChartStock.chartsMap[chartId]) {
		AnyChartStock.chartsMap[chartId].dispatchEvent(eventObj);
	}
}
AnyChartStock.setConfig = function(chartId, configObj) {
	if (chartId == null || configObj == null) return;
	if (AnyChartStock.chartsMap && AnyChartStock.chartsMap[chartId])
		AnyChartStock.chartsMap[chartId].objectModel = configObj;
}

AnyChartStock.getChartById = function(chartId) {	
	return (chartId != null && AnyChartStock.chartsMap && AnyChartStock.chartsMap[chartId]) ? AnyChartStock.chartsMap[chartId] : null;
}

AnyChartStock._chartsDrawCounter = 0;
AnyChartStock.onChartsDraw = null;
//--------------------------------------------------------------------------------------
//Disposing
//--------------------------------------------------------------------------------------

AnyChartStock.charts = [];
AnyChartStock.chartsMap = {};
AnyChartStock.register = function(stock) {
	stock.id = "__AnyChartStock___" + AnyChartStock.charts.length;
	
	AnyChartStock.chartsMap[stock.id] = stock;
	AnyChartStock.utils.push(AnyChartStock.charts, stock);
	stock._onChartDraw = function() {
	   AnyChartStock._chartsDrawCounter ++;
	   if (AnyChartStock._chartsDrawCounter == AnyChartStock.charts.length && AnyChartStock.onChartsDraw != null)
	       AnyChartStock.onChartsDraw();
	      
	   this._onChartDraw = null;
	};
}

AnyChartStock.disposeFlashObject = function(obj, id) {
	if (obj && obj.nodeName == "OBJECT") {
		if (AnyChartStock.platform.isIE && AnyChartStock.platform.isWin) {
			obj.style.display = "none";
			(function() {
				if (obj.readyState == 4) {
					if (AnyChartStock.platform.needFormFix && id != null)
						AnyChartStock.disposeFlashObjectInIE(window[id]);

					AnyChartStock.disposeFlashObjectInIE(obj);
				}
				else {
					setTimeout(arguments.callee, 10);
				}
			})();
		} else {
			obj.parentNode.removeChild(obj);
		}
	}
};

AnyChartStock.disposeFlashObjectInIE = function(obj) {
	for (var j in obj) {
		if (typeof obj[j] == "function") {
			obj[j] = null;
		}
	}
	if (obj.parentNode) obj.parentNode.removeChild(obj);
};

AnyChartStock.registerDispose = function() {
	if (AnyChartStock.platform.isIE && AnyChartStock.platform.isWin) {

		var dispose = function() {
			if (AnyChartStock) {
				if (AnyChartStock.utils && AnyChartStock.utils.listeners) {
					var len = AnyChartStock.utils.listeners.length;
					var i;
					for (i = 0; i < len; i++)
						AnyChartStock.utils.listeners[i][0].detachEvent(AnyChartStock.utils.listeners[i][1], AnyChartStock.utils.listeners[i][2]);
				}
				if (AnyChartStock.charts) {
					len = AnyChartStock.charts.length - 1;
					for (i = len; i >= 0; i--) {
						AnyChartStock.charts[i].dispose();
					}
				}

				for (i in AnyChartStock)
					AnyChartStock[i] = null;
			}

			AnyChartStock = null;
		}
		
		if (AnyChartStock && AnyChartStock.useIEOnBeforeUnload) {
			window.attachEvent("onbeforeunload", function() {
				dispose();
			});
		}
		window.attachEvent("onunload", function() {
			dispose();
		});
	}
};


//--------------------------------------------------------------------------------------
//Firefox print fix
//--------------------------------------------------------------------------------------
AnyChartStock.FFPrintFix = {};
AnyChartStock.FFPrintFix.fix = function(targetChart, targetNode, pngData, w, h, targetNodeName, targetId) {
	var head = document.getElementsByTagName("head");
	head = (head.length > 0) ? head[0] : null;
	if (head == null) return;
	
	targetChart.ffPrintScreenStyle = AnyChartStock.FFPrintFix.createDisplayStyle(head, w, h, targetNodeName, targetId);
	targetChart.ffPrintStyle = AnyChartStock.FFPrintFix.createPrintStyle(head, w, h, targetNodeName, targetId);
	targetChart.ffPrintFixImg = AnyChartStock.FFPrintFix.createImage(targetNode, pngData);
}

AnyChartStock.FFPrintFix.createDisplayStyle = function(head, w, h, targetNodeName, targetId) {
	//crete style node
	var style = document.createElement("style");
	style.setAttribute("type", "text/css");
	style.setAttribute("media", "screen");
	
	//write style.
	var objDescriptor = targetNodeName + "#" + targetId;
	var imgDescriptor = objDescriptor + " img";
	var objRule = " object { width:" + w + "; height:" + h + ";padding:0; margin:0; }\n";
	var imgRule = " { display: none; }";
	
	style.appendChild(document.createTextNode(objDescriptor + objRule));
	style.appendChild(document.createTextNode(imgDescriptor + imgRule));
	
	//add style to head
	return head.appendChild(style);
}

AnyChartStock.FFPrintFix.createPrintStyle = function(head, w, h, targetNodeName, targetId) {
	//crete style node
	var style = document.createElement("style");
	style.setAttribute("type", "text/css");
	style.setAttribute("media", "print");

	//write style.
	var objDescriptor = targetNodeName + "#" + targetId;
	var imgDescriptor = objDescriptor + " img";
	var objRule = " object { display: none; }\n";
	var imgRule = " { display: block; width: " + w + "; height: " + h + "; }";

	style.appendChild(document.createTextNode(objDescriptor + objRule));
	style.appendChild(document.createTextNode(imgDescriptor + imgRule));
	
	//add style to head
	return head.appendChild(style);
}

AnyChartStock.FFPrintFix.createImage = function(targetNode, pngData) {
	var img = document.createElement("img");
	img = targetNode.appendChild(img);
	img.src = "data:image/png;base64," + pngData;

	return img;
}

//--------------------------------------------------------------------------------------
//main()
//--------------------------------------------------------------------------------------
AnyChartStock.utils.registerDomLoad();
AnyChartStock.registerDispose();

//--------------------------------------------------------------------------------------
//AnyChartStock main code
//--------------------------------------------------------------------------------------

AnyChartStock.swfFile = null;
AnyChartStock.preloaderSWFFile = null;

AnyChartStock.messages = {
	preloaderInit: "Initializing... ",
	preloaderLoading: "Loading... ",
	init: "Initializing: ",
	loadingSettings: "Loading settings... ",
	loadingData: "Loading data... ",
	waitingForData: "Waiting for data",
	noDataText: null
}

AnyChartStock.resizing = { 
	mode: "recalculate",
	baseWidth: NaN,
	baseHeight: NaN,
	minWidth: NaN,
	maxWidth: NaN,
	minHeight: NaN,
	maxHeight: NaN
};

AnyChartStock.width = "100%";
AnyChartStock.height = "100%";
AnyChartStock.enableFirefoxPrintPreviewFix = false;
AnyChartStock.needConfig = false;

//ie onbeforeunload usage for dispose
AnyChartStock.useIEOnBeforeUnload = false;

AnyChartStock.prototype = {

    enablePreloader: true,

    //flash movie paths
    swfFile: null,
    preloaderSWFFile: null,

    //flash obj params
    id: null,
    width: null,
    height: null,
    bgColor: null,
    wMode: null,

    enableFirefoxPrintPreviewFix: false,
    needConfig: false,
    enableMouseMoveEvent: false,

    //flash obj
    flashObject: null,
    target: null,
    ffPrintFixImg: null,
    ffPrintScreenStyle: null,
    ffPrintStyle: null,

    //stock settings
    messages: null,
    xmlFile: null,
    jsonFile: null,
    _xmlData: null,
    _jsonData: null,

    objectModel: null,

    //resizing
    resizing: null,

    //------------------------------------------------------------------------------------------------------
    //  CONSTRUCTOR
    //------------------------------------------------------------------------------------------------------

    constructor: function (args) {
        this.swfFile = AnyChartStock.swfFile;
        this.preloaderSWFFile = AnyChartStock.preloaderSWFFile;

        if (args.length > 0) {
            this.swfFile = args[0];
            if (args.length > 1)
                this.preloaderSWFFile = args[1];
        }
        this.target = null;
        this.ffPrintFixImg = null;
        this.ffPrintScreenStyle = null;
        this.ffPrintStyle = null;

        this.enableMouseMoveEvent = false;

        this.enablePreloader = true;

        this.messages = {};
        this.messages.preloaderInit = AnyChartStock.messages.preloaderInit;
        this.messages.preloaderLoading = AnyChartStock.messages.preloaderLoading;
        this.messages.init = AnyChartStock.messages.init;
        this.messages.loadingSettings = AnyChartStock.messages.loadingSettings;
        this.messages.loadingData = AnyChartStock.messages.loadingData;
        this.messages.waitingForData = AnyChartStock.messages.waitingForData;
		this.messages.noDataText = AnyChartStock.messages.noDataText;

        this.resizing = {};
        this.resizing.mode = AnyChartStock.resizing.mode;
        this.resizing.baseWidth = AnyChartStock.resizing.baseWidth;
        this.resizing.baseHeight = AnyChartStock.resizing.baseHeight;
        this.resizing.minWidth = AnyChartStock.resizing.minWidth;
        this.resizing.maxWidth = AnyChartStock.resizing.maxWidth;
        this.resizing.minHeight = AnyChartStock.resizing.minHeight;
        this.resizing.maxHeight = AnyChartStock.resizing.maxHeight;

        this.width = AnyChartStock.width;
        this.height = AnyChartStock.height;
        this.bgColor = "#FFFFFF";

        this._isChartCreated = false;
        this._isHTMLWrited = false;
        this._needSetXMLFileAfterCreation = false;
        this._needSetJSONFileAfterCreation = false;
        this._needSetXMLDataAfterCreation = false;

        this.visible = true;

        this.enableFirefoxPrintPreviewFix = AnyChartStock.enableFirefoxPrintPreviewFix;
        this.needConfig = AnyChartStock.needConfig;

        this.objectModel = null;

        this.clearEvents();

        AnyChartStock.register(this);
    },

    //------------------------------------------------------------------------------------------------------
    //  HTML Embedding
    //------------------------------------------------------------------------------------------------------

    write: function (target) {
        this._isChartCreated = false;
        this._isHTMLWrited = false;
        if (!AnyChartStock.platform.hasRequiredVersion) return;
        if (arguments.length == 0) {
            target = "__chart_generated_container__" + this.id;
            document.write("<div id=\"" + target + "\"></div>");
        }
        this._createFlashObject(target);
    },

    _createFlashObject: function (target) {
        if (!AnyChartStock.utils.hasProp(target) || target == null) return;
        if (!AnyChartStock.platform.hasDom || (AnyChartStock.platform.webKit && AnyChartStock.platform.webKit < 312)) return;

        var ths = this;

        AnyChartStock.utils.addDomLoadEventListener(function () {
            if (typeof target == "string")
                ths._execCreateFlashObject(document.getElementById(target));
            else
                ths._execCreateFlashObject(target);
        });
    },

    _addParam: function (target, paramName, paramValue) {
        var node = document.createElement("param");
        node.setAttribute("name", paramName);
        node.setAttribute("value", paramValue);
        target.appendChild(node);
    },

    _generateStringParam: function (paramName, paramValue) {
        return "<param name=\"" + paramName + "\" value=\"" + paramValue + "\" />";
    },

    _rebuildExternalInterfaceFunctionForFormFix: function (obj, functionName) {
        eval('obj[functionName] = function(){return eval(this.CallFunction("<invoke name=\\"' + functionName + '\\" returntype=\\"javascript\\">" + __flash__argumentsToXML(arguments,0) + "</invoke>"));}');
    },

    _execCreateFlashObject: function (target) {
        this.target = target;
        this.enableFirefoxPrintPreviewFix = this.enableFirefoxPrintPreviewFix && AnyChartStock.platform.isFirefox;

        var width = this.width + "";
        var height = this.height + "";
        var path = this.preloaderSWFFile ? this.preloaderSWFFile : this.swfFile;

        if (AnyChartStock.platform.isIE && AnyChartStock.platform.isWin) {
            var htmlCode = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"";
            htmlCode += " id=\"" + this.id + "\"";
            htmlCode += " width=\"" + width + "\"";
            htmlCode += " height=\"" + height + "\"";
            htmlCode += " style=\"outline:none; visibility:" + (this.visible ? "visible" : "hidden") + "\"";
            htmlCode += " codebase=\"" + AnyChartStock.platform.protocol + "//fpdownload.macromedia.com/get/flashplayer/current/swflash.cab\">";

            htmlCode += this._generateStringParam("movie", path);
            htmlCode += this._generateStringParam("bgcolor", this.bgColor);
            htmlCode += this._generateStringParam("allowScriptAccess", "always");
            htmlCode += this._generateStringParam("allowFullScreen", "true");
            htmlCode += this._generateStringParam("flashvars", this._buildFlashVars());

            if (this.wMode != null)
                htmlCode += this._generateStringParam("wmode", this.wMode);

            htmlCode += "</object>";

            if (AnyChartStock.platform.needFormFix) {

                var targetForm = null;
                var tmp = target;
                while (tmp) {
                    if (tmp.nodeName != null && tmp.nodeName.toLowerCase() == "form") {
                        targetForm = tmp;
                        break;
                    }
                    tmp = tmp.parentNode;
                }
                if (targetForm != null) {

                    window[this.id] = {};
                    window[this.id].SetReturnValue = function () { };
                    target.innerHTML = htmlCode;

                    window[this.id].SetReturnValue = null;
                    var fncts = {};
                    for (var j in window[this.id]) {
                        if (typeof (window[this.id][j]) == 'function')
                            fncts[j] = window[this.id][j];
                    }
                    this.flashObject = window[this.id] = targetForm[this.id];

                    for (var j in fncts) {
                        this._rebuildExternalInterfaceFunctionForFormFix(this.flashObject, j);
                    }

                } else {
                    target.innerHTML = htmlCode;
                    this.flashObject = document.getElementById(this.id);
                }

            } else {
                target.innerHTML = htmlCode;
                this.flashObject = document.getElementById(this.id);
            }

        } else {
            var obj = document.createElement("object");
            obj.setAttribute("type", "application/x-shockwave-flash");
            obj.setAttribute("id", this.id);
            obj.setAttribute("width", width);
            obj.setAttribute("height", height);
            obj.setAttribute("data", path);
            obj.setAttribute("style", "outline:none; visibility: " + (this.visible ? "visible" : "hidden"));

            this._addParam(obj, "movie", path);
            this._addParam(obj, "bgcolor", this.bgColor);
            this._addParam(obj, "allowScriptAccess", "always");
            this._addParam(obj, "allowFullScreen", "true");
            this._addParam(obj, "flashvars", this._buildFlashVars());

            if (this.wMode != null)
                this._addParam(obj, "wmode", this.wMode);
            else if (AnyChartStock.platform.isOpera)
                this._addParam(obj, "wmode", "opaque");

            if (target.hasChildNodes()) {
                while (target.childNodes.length > 0) {
                    target.removeChild(target.firstChild);
                }
            }

            this.flashObject = target.appendChild(obj);
        }
        this._isHTMLWrited = this.flashObject != null;
    },

    _buildFlashVars: function () {
        var res = "";
        res = "__externalobjid=" + this.id;
        res += "&enablepreloader=" + this.enablePreloader;
        if (this.preloaderSWFFile != null) res += "&swffile=" + this.swfFile;
        if (this.xmlFile != null) res += "&xmlfile=" + this.xmlFile;
        if (this.jsonFile != null) res += "&jsonfile=" + this.jsonFile;
        if (this._xmlData != null || this._jsonData != null) res += "&__canProcessAfterCreate=0";
        if (this.needConfig) res += "&_needinitialconfig=1";
        if (this.messages) {
            if (this.messages.preloaderInit != null) res += "&preloaderInitText=" + this.messages.preloaderInit;
            if (this.messages.preloaderLoading != null) res += "&preloaderLoadingText=" + this.messages.preloaderLoading;
            if (this.messages.init != null) res += "&initText=" + this.messages.init;
            if (this.messages.loadingSettings != null) res += "&settingsLoadingText=" + this.messages.loadingSettings;
            if (this.messages.loadingData != null) res += "&dataloadingtext=" + this.messages.loadingData;
            if (this.messages.waitingForData != null) res += "&waitingfordatatext=" + this.messages.waitingForData;
			if (this.messages.noDataText != null) res += "&nodatatext=" + this.messages.noDataText;
        }
        if (this.resizing) {
            if (this.resizing.mode != null) res += "&resizingMode=" + this.resizing.mode;
            if (!isNaN(this.resizing.baseWidth)) res += "&baseWidth=" + this.resizing.baseWidth;
            if (!isNaN(this.resizing.baseHeight)) res += "&baseHeight=" + this.resizing.baseHeight;
            if (!isNaN(this.resizing.minWidth)) res += "&minWidth=" + this.resizing.minWidth;
            if (!isNaN(this.resizing.maxWidth)) res += "&maxWidth=" + this.resizing.maxWidth;
            if (!isNaN(this.resizing.minHeight)) res += "&minHeight=" + this.resizing.minHeight;
            if (!isNaN(this.resizing.maxHeight)) res += "&maxHeight=" + this.resizing.maxHeight;
        }
        res += "&__enablemousemoveevent=" + (this.enableMouseMoveEvent ? '1' : '0');

        return res;
    },

    //------------------------------------------------------------------------------------------------------
    //  Size update
    //------------------------------------------------------------------------------------------------------

    setSize: function (width, height) {
        this.width = width;
        this.height = height;
        if (this.flashObject) {
            this.flashObject.setAttribute("width", this.width + "");
            this.flashObject.setAttribute("height", this.height + "");
            this.updatePrintForFirefox();
        }
    },

    //------------------------------------------------------------------------------------------------------
    //  FIREFOX PRINT PREVIEW FIX
    //------------------------------------------------------------------------------------------------------
    _onBeforeChartDraw: function () {
        this._createFFPrintFixObjects();
    },

    _createFFPrintFixObjects: function () {
        if (!this.enableFirefoxPrintPreviewFix || this.target == null) return false;

        var imgData = this.getPNGImageBase64Encoded();
        if (imgData == null || imgData.length == 0) return false;

        var targetId = this.target.getAttribute("id");
        if (targetId == null) {
            targetId = "__stockchartcontainer__" + this.id;
            this.target.setAttribute("id", targetId);
        }

        AnyChartStock.FFPrintFix.fix(this, this.target, imgData, this.width + "", this.height + "", this.target.nodeName, targetId);
        return true;
    },

    _disposeFFPrintFixObjects: function () {
        if (!this.enableFirefoxPrintPreviewFix || this.target == null) return;

        if (this.ffPrintFixImg) {
            if (this.ffPrintFixImg.parentNode) this.ffPrintFixImg.parentNode.removeChild(this.ffPrintFixImg);
            this.ffPrintFixImg = null;
        }

        if (this.ffPrintScreenStyle) {
            if (this.ffPrintScreenStyle.parentNode) this.ffPrintScreenStyle.parentNode.removeChild(this.ffPrintScreenStyle);
            this.ffPrintScreenStyle = null;
        }

        if (this.ffPrintStyle) {
            if (this.ffPrintStyle.parentNode) this.ffPrintStyle.parentNode.removeChild(this.ffPrintStyle);
            this.ffPrintStyle = null;
        }
    },

    updatePrintForFirefox: function () {
        this._disposeFFPrintFixObjects();
        return this._createFFPrintFixObjects();
    },

    //------------------------------------------------------------------------------------------------------
    //  EVENT DISPATCHING
    //------------------------------------------------------------------------------------------------------

    onChartCreate: null,
    onChartRender: null,
    onChartDraw: null,
    onChartDataLoad: null,
	onNoData: null,
	onGotData: null,
    onSelectedRangeChange: null,
    onChartMouseOut: null,
    onChartMouseOver: null,
    onChartMouseDown: null,
    onChartMouseUp: null,
    onChartMouseMove: null,
    onEventMarkerMouseOver: null,
    onEventMarkerMouseOut: null,
    onEventMarkerSelect: null,
    onEventMarkerDeselect: null,
    onEventMarkerClick: null,
    onEventMarkerDoubleClick: null,

    onMergedEventMarkerMouseOver: null,
    onMergedEventMarkerMouseOut: null,
    onMergedEventMarkerSelect: null,
    onMergedEventMarkerDeselect: null,
    onMergedEventMarkerClick: null,
    onMergedEventMarkerDoubleClick: null,

    onContextMenuCustomItemClick: null,

    onAnnotationDrawingStart: null,
    onAnnotationDrawingProgress: null,
    onAnnotationDrawingFinish: null,
    onAnnotationSelect: null,
    onAnnotationDeselect: null,
    onAnnotationRemove: null,

    onAnnotationEditingStart: null,
    onAnnotationEditingProgress: null,
    onAnnotationEditingFinish: null,

    clearEvents: function () {
        this.onChartCreate = null;
        this.onChartRender = null;
        this.onChartDraw = null;
        this.onChartDataLoad = null;
		this.onNoData = null;
		this.onGotData = null;
        this.onSelectedRangeChange = null;
        this.onChartMouseOut = null;
        this.onChartMouseOver = null;
        this.onChartMouseDown = null;
        this.onChartMouseUp = null;
        this.onChartMouseMove = null;
        this.onEventMarkerMouseOver = null;
        this.onEventMarkerMouseOut = null;
        this.onEventMarkerSelect = null;
        this.onEventMarkerDeselect = null;
        this.onEventMarkerClick = null;
        this.onEventMarkerDoubleClick = null;
        this.onMergedEventMarkerMouseOver = null;
        this.onMergedEventMarkerMouseOut = null;
        this.onMergedEventMarkerSelect = null;
        this.onMergedEventMarkerDeselect = null;
        this.onMergedEventMarkerClick = null;
        this.onMergedEventMarkerDoubleClick = null;
        this.onContextMenuCustomItemClick = null;
        this.onAnnotationDrawingStart = null;
        this.onAnnotationDrawingProgress = null;
        this.onAnnotationDrawingFinish = null;
        this.onAnnotationEditingStart = null;
        this.onAnnotationEditingProgress = null;
        this.onAnnotationEditingFinish = null;
        this.onAnnotationSelect = null;
        this.onAnnotationDeselect = null;
        this.onAnnotationRemove = null;
    },


    dispatchEvent: function (e) {
        if (e == null || e.type == null) return;
        switch (e.type) {
            case "create":
                this._onBeforeChartCreate();
                if (this.onChartCreate != null) this.onChartCreate();
                break;
            case "render":
                if (this.onChartRender != null) this.onChartRender();
                break;
            case "draw":
                this._onBeforeChartDraw();
                if (this.onChartDraw != null) this.onChartDraw();
                if (this._onChartDraw != null) this._onChartDraw();
                break;
			case "gotData":
				if (this.onGotData != null) this.onGotData();
                break;
			case "noData":
				if (this.onNoData != null) this.onNoData();
                break;
            case "dataLoad":
                if (this.onChartDataLoad != null) this.onChartDataLoad();
                break;
            case "selectedRangeChange":
                if (this.onSelectedRangeChange != null) this.onSelectedRangeChange(e.data.startDate, e.data.endDate, e.data.phase, e.data.sender);
                break;
            case "chartMouseOut":
                if (this.onChartMouseOut != null) this.onChartMouseOut(e.data.chartId);
                break;
            case "chartMouseOver":
                if (this.onChartMouseOver != null) this.onChartMouseOver(e.data.chartId, e.data.date, e.data.mouseX, e.data.mouseY);
                break;
            case "chartMouseDown":
                if (this.onChartMouseDown != null) this.onChartMouseDown(e.data.chartId, e.data.date, e.data.mouseX, e.data.mouseY);
                break;
            case "chartMouseUp":
                if (this.onChartMouseUp != null) this.onChartMouseUp(e.data.chartId, e.data.date, e.data.mouseX, e.data.mouseY);
                break;
            case "chartMouseMove":
                if (this.onChartMouseMove != null) this.onChartMouseMove(e.data.chartId, e.data.date, e.data.mouseX, e.data.mouseY);
                break;
            case "eventMarkerMouseOver":
                if (this.onEventMarkerMouseOver != null) this.onEventMarkerMouseOver(e.data.eventMarker);
                break;
            case "eventMarkerMouseOut":
                if (this.onEventMarkerMouseOut != null) this.onEventMarkerMouseOut(e.data.eventMarker);
                break;
            case "eventMarkerClick":
                if (this.onEventMarkerClick != null) this.onEventMarkerClick(e.data.eventMarker);
                break;
            case "eventMarkerDoubleClick":
                if (this.onEventMarkerDoubleClick != null) this.onEventMarkerDoubleClick(e.data.eventMarker);
                break;
            case "eventMarkerSelect":
                if (this.onEventMarkerSelect != null) this.onEventMarkerSelect(e.data.eventMarker, e.data.action);
                break;
            case "eventMarkerDeselect":
                if (this.onEventMarkerDeselect != null) this.onEventMarkerDeselect(e.data.eventMarker);
                break;
            case "mergedEventMarkerMouseOver":
                if (this.onMergedEventMarkerMouseOver != null) this.onMergedEventMarkerMouseOver(e.data.eventMarkers);
                break;
            case "mergedEventMarkerMouseOut":
                if (this.onMergedEventMarkerMouseOut != null) this.onMergedEventMarkerMouseOut(e.data.eventMarkers);
                break;
            case "mergedEventMarkerClick":
                if (this.onMergedEventMarkerClick != null) this.onMergedEventMarkerClick(e.data.eventMarkers);
                break;
            case "mergedEventMarkerDoubleClick":
                if (this.onMergedEventMarkerDoubleClick != null) this.onMergedEventMarkerDoubleClick(e.data.eventMarkers);
                break;
            case "mergedEventMarkerSelect":
                if (this.onMergedEventMarkerSelect != null) this.onMergedEventMarkerSelect(e.data.eventMarkers, e.data.action);
                break;
            case "mergedEventMarkerDeselect":
                if (this.onMergedEventMarkerDeselect != null) this.onMergedEventMarkerDeselect(e.data.eventMarkers);
                break;
            case "customContextMenuItemClick":
                if (this.onContextMenuCustomItemClick != null) this.onContextMenuCustomItemClick(e.itemId);
                break;
            case "annotationDrawingStart":
                if (this.onAnnotationDrawingStart != null) this.onAnnotationDrawingStart(e.annotationId);
                break;
            case "annotationDrawingProgress":
                if (this.onAnnotationDrawingProgress != null) this.onAnnotationDrawingProgress(e.annotationId, e.mouseX, e.mouseY);
                break;
            case "annotationDrawingFinish":
                if (this.onAnnotationDrawingFinish != null) this.onAnnotationDrawingFinish(e.annotationId);
                break;
            case "annotationEditingStart":
                if (this.onAnnotationEditingStart != null) this.onAnnotationEditingStart(e.annotationId);
                break;
            case "annotationEditingProgress":
                if (this.onAnnotationEditingProgress != null) this.onAnnotationEditingProgress(e.annotationId);
                break;
            case "annotationEditingFinish":
                if (this.onAnnotationEditingFinish != null) this.onAnnotationEditingFinish(e.annotationId);
                break;
            case "annotationSelect":
                if (this.onAnnotationSelect != null) this.onAnnotationSelect(e.annotationId);
                break;
            case "annotationDeselect":
                if (this.onAnnotationDeselect != null) this.onAnnotationDeselect(e.annotationId);
                break;
            case "annotationRemove":
                if (this.onAnnotationRemove != null) this.onAnnotationRemove(e.annotationId, e.annotationJSON);
                break;
        }
    },

    //------------------------------------------------------------------------------------------------------
    //  show/hide
    //------------------------------------------------------------------------------------------------------

    visible: true,

    show: function () {
        this.visible = true;
        if (this.flashObject) {
            this.flashObject.style.visibility = "visible";
            this.flashObject.setAttribute("width", this.width + "");
            this.flashObject.setAttribute("height", this.height + "");
            if (this.ffPrintFixImg) {
                this.ffPrintFixImg.removeAttribute("width");
                this.ffPrintFixImg.removeAttribute("height");
            }
        }
    },

    hide: function () {
        this.visible = false;
        if (this.flashObject) {
            this.flashObject.style.visibility = "hidden";
            this.flashObject.setAttribute("width", "1px");
            this.flashObject.setAttribute("height", "1px");
            if (this.ffPrintFixImg) {
                this.ffPrintFixImg.setAttribute("width", "1px");
                this.ffPrintFixImg.setAttribute("height", "1px");
            }
        }
    },

    //------------------------------------------------------------------------------------------------------
    //  DISPOSING
    //------------------------------------------------------------------------------------------------------

    dispose: function () {
        this.remove();
    },

    removeFlashObject: function () {
        if (this.flashObject) {
            if (this.flashObject.dispose) this.flashObject.dispose();
            AnyChartStock.disposeFlashObject(this.flashObject, this.id);

            this._disposeFFPrintFixObjects();
        }
        this.flashObject = null;
    },

    remove: function () {
        this.removeFlashObject();
        if (AnyChartStock && AnyChartStock.charts) {
            for (var i = 0; i < AnyChartStock.charts.length; i++) {
                if (AnyChartStock.charts[i] == this) {
                    AnyChartStock.charts[i] = null;
                    AnyChartStock.charts.splice(i, 1);
                    break;
                }
            }
        }
        if (AnyChartStock && AnyChartStock.chartsMap && this.id != null) {
            AnyChartStock.chartsMap[this.id] = null;
        }
    },

    //------------------------------------------------------------------------------------------------------
    //  CHART DATA MANIPULATION
    //------------------------------------------------------------------------------------------------------

    _isChartCreated: false,
    _isHTMLWrited: false,
    _needSetXMLFileAfterCreation: false,
    _needSetJSONFileAfterCreation: false,
    _needSetXMLDataAfterCreation: false,

    _onBeforeChartCreate: function () {
        this._isChartCreated = true;
        if (this._needSetXMLFileAfterCreation) this._execSetXMLFile();
        if (this._needSetJSONFileAfterCreation) this._execSetJSONFile();
        if (this._needSetXMLDataAfterCreation) {
            if (this._xmlData != null)
                this._execSetXMLData();
            else if (this._jsonData != null)
                this._execSetJSONData();
        }
    },

    setXMLFile: function (xmlFile) {
        this.xmlFile = xmlFile;
        var rebuildObjectModel = arguments.length > 1 ? arguments[0] : true;

        if (this._isChartCreated) {
            if (this._isHTMLWrited)
                return this._execSetXMLFile(rebuildObjectModel);
            return false;
        }

        this._needSetXMLFileAfterCreation = true;
        return true;
    },

    setJSONFile: function (jsonFile) {
        this.jsonFile = jsonFile;
        var rebuildObjectModel = arguments.length > 1 ? arguments[0] : true;

        if (this._isChartCreated) {
            if (this._isHTMLWrited)
                return this._execSetJSONFile(rebuildObjectModel);
            return false;
        }
        this._needSetJSONFileAfterCreation = true;
        return true;
    },

    _execSetXMLFile: function () {
        var rebuildObjectModel = arguments.length > 1 ? arguments[0] : true;
        if (this.xmlFile != null && this.flashObject && this.flashObject.setXMLFile)
            return this.flashObject.setXMLFile(this.xmlFile, rebuildObjectModel);
        return false;
    },

    _execSetJSONFile: function () {
        var rebuildObjectModel = arguments.length > 1 ? arguments[0] : true;
        if (this.jsonFile != null && this.flashObject && this.flashObject.setJSONFile)
            return this.flashObject.setJSONFile(this.jsonFile, rebuildObjectModel);
        return false;
    },

    _isXMLData: function (data) {
        var strData = String(data);
        while (strData.charAt(0) == " " && strData.length > 0) strData = strData.substr(1);
        return strData.charAt(0) == "<";
    },

    setConfig: function (data) {
        if (data == null) return false;

        var isXML = this._isXMLData(data);

        if (isXML)
            this._xmlData = String(data);
        else
            this._jsonData = data;

        if (this._isChartCreated) {
            if (isXML)
                return this._execSetXMLData();

            return this._execSetJSONData();
        } else {
            this._needSetXMLDataAfterCreation = this._xmlData != null || this._jsonData != null;
            return true;
        }

        return false;
    },

    _execSetXMLData: function () {
        if (this._xmlData != null && this.flashObject && this.flashObject.setConfig)
            return this.flashObject.setConfig(this._xmlData);
        return false;
    },

    _execSetJSONData: function () {
        if (this._jsonData != null && this.flashObject && this.flashObject.setConfig)
            return this.flashObject.setConfig(this._jsonData);
        return false;
    },

    setSettings: function (data, preserveSelectedRange) {
        if (data == null) return false;
        if (!this._isChartCreated) return false;
        if (this.flashObject == null) return false;
        if (typeof (this.flashObject.setSettings) == "undefined") return false;

        if (arguments.length < 2) preserveSelectedRange = true;

        return this.flashObject.setSettings(data, preserveSelectedRange);
    },

    setEventMarkers: function (data) {
        if (data == null) return false;
        if (!this._isChartCreated) return false;
        if (this.flashObject == null) return false;
        if (typeof (this.flashObject.setEventMarkers) == "undefined") return false;

        return this.flashObject.setEventMarkers(data);
    },

    //------------------------------------------------------------------------------------------------------
    //  OTHER CHART MANIPULATION METHODS
    //------------------------------------------------------------------------------------------------------    

    getCurrentConfiguration: function () {
        return (this.flashObject && this.flashObject.getCurrentConfiguration) ? this.flashObject.getCurrentConfiguration(arguments.length > 0 ? arguments[0] : true) : null;
    },

    getCurrentConfigurationXML: function () {
        return (this.flashObject && this.flashObject.getCurrentConfigurationXML) ? this.flashObject.getCurrentConfigurationXML(arguments.length > 0 ? arguments[0] : true) : null;
    },

    getCurrentDataGroupingInterval: function () {
        return (this.flashObject && this.flashObject.getCurrentDataGroupingInterval) ? this.flashObject.getCurrentDataGroupingInterval() : null;
    },

    getCurrentYAxisInfo: function (chartId, axisId) {
        return (this.flashObject && this.flashObject.getCurrentDataGroupingInterval) ? this.flashObject.getCurrentYAxisInfo(chartId, axisId) : null;
    },

    showWaitingState: function () {
        var message = arguments.length > 0 ? arguments[0] : "Waiting...";
        message = message.toString().split("\r\n").join("\n");
        if (this._isChartCreated && this.flashObject && this.flashObject.showWaitingState)
            return this.flashObject.showWaitingState(message);
        return false;
    },

    hideWaitingState: function () {
        if (this._isChartCreated && this.flashObject && this.flashObject.hideWaitingState)
            return this.flashObject.hideWaitingState();
        return false;
    },
	
	showOverlayMessage: function () {
        var message = arguments.length > 0 ? arguments[0] : "Waiting...";
        message = message.toString().split("\r\n").join("\n");
        if (this._isChartCreated && this.flashObject && this.flashObject.showOverlayMessage)
            return this.flashObject.showOverlayMessage(message);
        return false;
    },

    hideOverlayMessage: function () {
        if (this._isChartCreated && this.flashObject && this.flashObject.hideOverlayMessage)
            return this.flashObject.hideOverlayMessage();
        return false;
    },

    exportAsPNG: function () {
        var settings = (arguments.length == 1) ? arguments[0] : null;

        if (this._isChartCreated && this.flashObject && this.flashObject.exportAsPNG)
            return this.flashObject.exportAsPNG(settings);
        return false;
    },

    exportAsJPG: function () {
        var settings = (arguments.length == 1) ? arguments[0] : null;

        if (this._isChartCreated && this.flashObject && this.flashObject.exportAsJPG)
            return this.flashObject.exportAsJPG(settings);
        return false;
    },

    exportAsPDF: function () {
        var settings = (arguments.length == 1) ? arguments[0] : null;

        if (this._isChartCreated && this.flashObject && this.flashObject.exportAsPDF)
            return this.flashObject.exportAsPDF(settings);
        return false;
    },

    exportAsInteractivePDF: function () {
        var settings = (arguments.length == 1) ? arguments[0] : null;

        if (this._isChartCreated && this.flashObject && this.flashObject.exportAsInteractivePDF)
            return this.flashObject.exportAsInteractivePDF(settings);
        return false;
    },

    printChart: function () {
        var settings = (arguments.length == 1) ? arguments[0] : null;

        if (this._isChartCreated && this.flashObject && this.flashObject.printChart)
            return this.flashObject.printChart(settings);
        return false;
    },

    getPNGImageBase64Encoded: function () {
        var settings = (arguments.length == 1) ? arguments[0] : null;

        return (this._isChartCreated && this.flashObject && this.flashObject.getPNGImageBase64Encoded) ? this.flashObject.getPNGImageBase64Encoded(settings) : null;
    },

    getJPGImageBase64Encoded: function () {
        var settings = (arguments.length == 1) ? arguments[0] : null;

        return (this._isChartCreated && this.flashObject && this.flashObject.getJPGImageBase64Encoded) ? this.flashObject.getJPGImageBase64Encoded(settings) : null;
    },

    getPDFBase64Encoded: function () {
        var settings = (arguments.length == 1) ? arguments[0] : null;

        return (this._isChartCreated && this.flashObject && this.flashObject.getPDFBase64Encoded) ? this.flashObject.getPDFBase64Encoded(settings) : null;
    },

    getInteractivePDFBase64Encoded: function () {
        var settings = (arguments.length == 1) ? arguments[0] : null;

        return (this._isChartCreated && this.flashObject && this.flashObject.getInteractivePDFBase64Encoded) ? this.flashObject.getInteractivePDFBase64Encoded(settings) : null;
    },

    //------------------------------------------------------------------------------------------------------
    //  Object model features
    //------------------------------------------------------------------------------------------------------

    applyConfigChanges: function () {
        if (this.objectModel != null)
            return this.setConfig(this.objectModel);
        return false;
    },

    applySettingsChanges: function (preserveSelectedRange) {
        if (arguments.length == 0) preserveSelectedRange = true;
        if (this.objectModel != null && typeof this.objectModel.settings != "undefined")
            return this.setSettings(this.objectModel.settings, preserveSelectedRange);
        return false;
    },

    applyEventMarkersChanges: function () {
        if (this.objectModel != null && typeof this.objectModel.eventMarkers != "undefined")
            return this.setEventMarkers(this.objectModel.eventMarkers);
        return false;
    },

    getChartById: function (id) {
        if (id == null || this.objectModel == null || this.objectModel.settings == null || this.objectModel.settings.charts == null) return null;
        var charts = this.objectModel.settings.charts;
        for (var i = 0; i < charts.length; i++) {
            if (charts[i] != null && typeof charts[i].id != "undefined" && charts[i].id == id) return charts[i];
        }
        return null;
    },

    getSeriesById: function (chartId, seriesId) {
        var chart = this.getChartById(chartId);
        if (chart == null || seriesId == null || chart.seriesList == null) return null;
        var series = chart.seriesList;
        for (var i = 0; i < series.length; i++) {
            if (series[i] != null && typeof series[i].id != "undefined" && series[i].id == seriesId) return series[i];
        }
        return null;
    },

    getTechIndicatorById: function (chartId, indicatorId) {
        var chart = this.getChartById(chartId);
        if (chart == null || indicatorId == null || chart.technicalIndicators == null) return null;
        var list = chart.technicalIndicators;
        for (var i = 0; i < list.length; i++) {
            if (list[i] != null && typeof list[i].id != "undefined" && list[i].id == indicatorId) return list[i];
        }
        return null;
    },

    getEventMarkersGroupById: function (groupId) {
        if (this.objectModel == null || this.objectModel.eventMarkers == null || this.objectModel.eventMarkers.groups == null) return null;
        var groups = this.objectModel.eventMarkers.groups;
        for (var i = 0; i < groups.length; i++) {
            if (groups[i] != null && typeof groups[i].id != "undefined" && groups[i].id == groupId) return groups[i];
        }
        return null;
    },

    getEventMarkerById: function (groupId, eventMarkerId) {
        var group = this.getEventMarkersGroupById(groupId);
        if (group && group.events) {
            for (var i = 0; i < group.events.length; i++) {
                if (group.events[i] != null && typeof group.events[i].id != "undefined" && group.events[i].id == eventMarkerId)
                    return group.events[i];
            }
        }
        return null;
    },

    //------------------------------------------------------------------------------------------------------
    //  Dynamic chart info
    //------------------------------------------------------------------------------------------------------

    getSeriesValue: function (chartId, seriesId, opt_searchForNotMissing) {
        return (this.flashObject && this.flashObject.getSeriesValue) ? this.flashObject.getSeriesValue(chartId, seriesId, opt_searchForNotMissing) : null;
    },

    getSeriesValueChange: function (chartId, seriesId, opt_searchForNotMissing) {
        return (this.flashObject && this.flashObject.getSeriesValueChange) ? this.flashObject.getSeriesValueChange(chartId, seriesId, opt_searchForNotMissing) : null;
    },

    getSeriesPercentValueChange: function (chartId, seriesId, opt_searchForNotMissing) {
        return (this.flashObject && this.flashObject.getSeriesPercentValueChange) ? this.flashObject.getSeriesPercentValueChange(chartId, seriesId, opt_searchForNotMissing) : null;
    },

    getSeriesOpenValue: function (chartId, seriesId, opt_searchForNotMissing) {
        return (this.flashObject && this.flashObject.getSeriesOpenValue) ? this.flashObject.getSeriesOpenValue(chartId, seriesId, opt_searchForNotMissing) : null;
    },

    getSeriesCloseValue: function (chartId, seriesId, opt_searchForNotMissing) {
        return (this.flashObject && this.flashObject.getSeriesCloseValue) ? this.flashObject.getSeriesCloseValue(chartId, seriesId, opt_searchForNotMissing) : null;
    },

    getSeriesHighValue: function (chartId, seriesId, opt_searchForNotMissing) {
        return (this.flashObject && this.flashObject.getSeriesHighValue) ? this.flashObject.getSeriesHighValue(chartId, seriesId, opt_searchForNotMissing) : null;
    },

    getSeriesLowValue: function (chartId, seriesId, opt_searchForNotMissing) {
        return (this.flashObject && this.flashObject.getSeriesLowValue) ? this.flashObject.getSeriesLowValue(chartId, seriesId, opt_searchForNotMissing) : null;
    },

    getSeriesCustomValue: function (chartId, seriesId, valueField, opt_searchForNotMissing) {
        return (this.flashObject && this.flashObject.getSeriesCustomValue) ? this.flashObject.getSeriesCustomValue(chartId, seriesId, valueField, opt_searchForNotMissing) : null;
    },

    getFirstDate: function () {
        return (this.flashObject && this.flashObject.getFirstDate) ? this.flashObject.getFirstDate() : null;
    },

    getLastDate: function () {
        return (this.flashObject && this.flashObject.getLastDate) ? this.flashObject.getLastDate() : null;
    },

    getFirstVisibleDate: function () {
        return (this.flashObject && this.flashObject.getFirstVisibleDate) ? this.flashObject.getFirstVisibleDate() : null;
    },

    getLastVisibleDate: function () {
        return (this.flashObject && this.flashObject.getLastVisibleDate) ? this.flashObject.getLastVisibleDate() : null;
    },

    getTechnicalIndicatorValue: function (chartId, techIndicatorId, opt_searchForNotMissing) {
        return (this.flashObject && this.flashObject.getTechnicalIndicatorValue) ?
            this.flashObject.getTechnicalIndicatorValue(chartId, techIndicatorId, opt_searchForNotMissing) : 
            null;
    },

    getDataSetCSV: function (dataSetId, columnsOrder, dateTimeFormat, colsSeparator, rowsSeparator) {
        return (this.flashObject && this.flashObject.getDataSetCSV) ?
            this.flashObject.getDataSetCSV(dataSetId, columnsOrder, dateTimeFormat, colsSeparator, rowsSeparator) : 
            null;
    }, 

    //------------------------------------------------------------------------------------------------------
    //  zoom/scroll
    //------------------------------------------------------------------------------------------------------

    zoomTo: function (startDate, endDate) {
        if (this.flashObject && this.flashObject.zoomTo)
            return this.flashObject.zoomTo(startDate, endDate);
        return false;
    },

    scrollTo: function (startDate) {
        if (this.flashObject && this.flashObject.scrollTo)
            return this.flashObject.scrollTo(startDate);
        return false;
    },

    selectRangeById: function (id) {
        if (this.flashObject && this.flashObject.selectRangeById)
            return this.flashObject.selectRangeById(id);
        return false;
    },

    selectRange: function (type) {
        var unit = null;
        var count = 1;
        var anchor = "LastDate";
        if (arguments.length > 1) unit = arguments[1];
        if (arguments.length > 2) count = arguments[2];
        if (arguments.length > 3) anchor = arguments[3];

        if (this.flashObject && this.flashObject.selectRange)
            return this.flashObject.selectRange(type, unit, count, anchor);
        return false;
    },

    //------------------------------------------------------------------------------------------------------
    // Data append
    //------------------------------------------------------------------------------------------------------

    appendData: function (dataSetId, csvData) {
        var delCount = 0;
        if (arguments.length > 2) delCount = arguments[2];
        if (this.flashObject && this.flashObject.appendData)
            return this.flashObject.appendData(dataSetId, csvData, delCount);
        return false;
    },

    removeDataRow: function (dataSetId, date) {
        if (this.flashObject && this.flashObject.removeDataRow)
            return this.flashObject.removeDataRow(dataSetId, date);
        return false;
    },

    removeDataRange: function (dataSetId, rangeStart, rangeEnd) {
        if (this.flashObject && this.flashObject.removeDataRange)
            return this.flashObject.removeDataRange(dataSetId, rangeStart, rangeEnd);
        return false;
    },

    commitDataChanges: function () {
        if (this.flashObject && this.flashObject.commitDataChanges)
            return this.flashObject.commitDataChanges();
        return false;
    },

    //------------------------------------------------------------------------------------------------------
    // Interactivity
    //------------------------------------------------------------------------------------------------------

    disableInteractivity: function () {
        if (this.flashObject && this.flashObject.disableInteractivity)
            return this.flashObject.disableInteractivity();
        return false;
    },

    enableInteractivity: function () {
        if (this.flashObject && this.flashObject.disableInteractivity)
            return this.flashObject.enableInteractivity();
        return false;
    },

    //------------------------------------------------------------------------------------------------------
    // Event markers
    //------------------------------------------------------------------------------------------------------

    selectEventMarker: function (groupId, eventMarkerId) {
        if (this.flashObject && this.flashObject.selectEventMarker)
            return this.flashObject.selectEventMarker(groupId, eventMarkerId);
        return false;
    },

    resetEventMarkerSelection: function (chartId) {
        if (this.flashObject && this.flashObject.resetEventMarkerSelection)
            return this.flashObject.resetEventMarkerSelection(chartId);
        return false;
    },

    showEventMarker: function (groupId, eventMarkerId) {
        if (this.flashObject && this.flashObject.showEventMarker)
            return this.flashObject.showEventMarker(groupId, eventMarkerId);
        return false;
    },

    hideEventMarker: function (groupId, eventMarkerId) {
        if (this.flashObject && this.flashObject.hideEventMarker)
            return this.flashObject.hideEventMarker(groupId, eventMarkerId);
        return false;
    },

    showEventMarkerGroup: function (groupId) {
        if (this.flashObject && this.flashObject.showEventMarkerGroup)
            return this.flashObject.showEventMarkerGroup(groupId);
        return false;
    },

    hideEventMarkerGroup: function (groupId) {
        if (this.flashObject && this.flashObject.hideEventMarkerGroup)
            return this.flashObject.hideEventMarkerGroup(groupId);
        return false;
    },

    addEventMarker: function (groupId, eventMarkerNode) {
        if (this.flashObject && this.flashObject.addEventMarker)
            return this.flashObject.addEventMarker(groupId, eventMarkerNode);
        return false;
    },

    removeEventMarker: function (groupId, eventMarkerId) {
        if (this.flashObject && this.flashObject.removeEventMarker)
            return this.flashObject.removeEventMarker(groupId, eventMarkerId);
        return false;
    },

    addEventMarkerGroup: function (chartId, seriesId, groupNode) {
        if (this.flashObject && this.flashObject.addEventMarkerGroup)
            return this.flashObject.addEventMarkerGroup(chartId, seriesId, groupNode);
        return false;
    },

    removeEventMarkerGroup: function (groupId) {
        if (this.flashObject && this.flashObject.removeEventMarkerGroup)
            return this.flashObject.removeEventMarkerGroup(groupId);
        return false;
    },

    commitEventMarkersChanges: function () {
        if (this.flashObject && this.flashObject.commitEventMarkersChanges)
            return this.flashObject.commitEventMarkersChanges();
        return false;
    },

    updateEventMarker: function (groupId, eventMarkerId, eventMarkerNode) {
        if (this.flashObject && this.flashObject.updateEventMarker)
            return this.flashObject.updateEventMarker(groupId, eventMarkerId, eventMarkerNode);
        return false;
    },

    //------------------------------------------------------------------------------------------------------
    // Annotations
    //------------------------------------------------------------------------------------------------------

    getAnnotationAsJSON: function (annotationId) {
        if (this.flashObject && this.flashObject.getAnnotationAsJSON)
            return this.flashObject.getAnnotationAsJSON(annotationId);
        return null;
    },

    getAnnotationAsXML: function (annotationId) {
        if (this.flashObject && this.flashObject.getAnnotationAsXML)
            return this.flashObject.getAnnotationAsXML(annotationId);
        return null;
    },

    addAnnotation: function (annotationNode) {
        if (this.flashObject && this.flashObject.addAnnotation)
            return this.flashObject.addAnnotation(annotationNode);
        return false;
    },

    updateAnnotation: function (annotationId, annotationNode) {
        if (this.flashObject && this.flashObject.updateAnnotation)
            return this.flashObject.updateAnnotation(annotationId, annotationNode);
        return false;
    },

    removeAnnotation: function (annotationId) {
        if (this.flashObject && this.flashObject.removeAnnotation)
            return this.flashObject.removeAnnotation(annotationId);
        return false;
    },

    removeAllAnnotations: function () {
        if (this.flashObject && this.flashObject.removeAllAnnotations)
            return this.flashObject.removeAllAnnotations();
        return false;
    },

    getSelectedAnnotationId: function () {
        if (this.flashObject && this.flashObject.getSelectedAnnotationId)
            return this.flashObject.getSelectedAnnotationId();
        return null;
    },

    selectAnnotation: function (annotationId) {
        if (this.flashObject && this.flashObject.selectAnnotation)
            return this.flashObject.selectAnnotation(annotationId);
        return false;
    },

    deselectAnnotaion: function () {
        if (this.flashObject && this.flashObject.deselectAnnotaion)
            return this.flashObject.deselectAnnotaion();
        return false;
    },
	
	deselectAnnotation: function () {
        if (this.flashObject && this.flashObject.deselectAnnotation)
            return this.flashObject.deselectAnnotation();
        return false;
    },

    startDrawingAnnotation: function (annotationType, opt_annotationNode) {
        if (this.flashObject && this.flashObject.startDrawingAnnotation)
            if (this.flashObject.startDrawingAnnotation(annotationType, opt_annotationNode)) {
                this.flashObject.focus();
                return true;
            } else
                return false;
        return false;
    },

    stopDrawingAnnotation: function () {
        if (this.flashObject && this.flashObject.stopDrawingAnnotation)
            return this.flashObject.stopDrawingAnnotation();
        return false;
    },

    getAnnotationListAsJSON: function () {
        if (this.flashObject && this.flashObject.getAnnotationListAsJSON)
            return this.flashObject.getAnnotationListAsJSON();
        return null;
    },

    getAnnotationListAsXML: function () {
        if (this.flashObject && this.flashObject.getAnnotationListAsXML)
            return this.flashObject.getAnnotationListAsXML();
        return null;
    },

    setAnnotationList: function (annotationsNode) {
        if (this.flashObject && this.flashObject.setAnnotationList)
            return this.flashObject.setAnnotationList(annotationsNode);
        return false;
    }
};

}