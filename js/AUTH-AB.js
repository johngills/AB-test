;(function(window, document, abd, undefined) {
	var AB = function() {
		var data = abd;
		this.data = data;
		
		AB.prototype.isFeatureA = function(tag) {
			var test = this.isFeatureB(tag);
			return !test;
		};
		
		AB.prototype.isFeatureB = function(tag) {
		    var test = false,
		    	l    = this.data.length;	    
		    for (i=0; i<l; i++) {
		        if(this.data[i]['feature_tag'] === tag) {
		            if(this.data[i]['feature'] === 'B') {
		            	test = true;
		            	break;
		            }
		        }
		    }
		    return test;
		};

		
		/**
		 * cb can be an object, function, or route and don't have to match
		 * if cb is string, it will be treated as a route
		 * ex: execute('testTag',_.bind(myFunc, myObj),'#home/test/1234') 
		 * if cb is an object, a function name (method) and optional (params)
		 * if cb is route but doesn not start with hash, it will be added  
		 * @param string tag
		 * @param mixed cbA
		 * @param mixed cbB
		 * @returns {Boolean}
		 */


		AB.prototype.execute = function(tag,cbB,cbA) {
		    var type, obj, cb;
		    if (this.isFeatureB(tag)) {
		    	cb = cbB;
		    } else if (cbA !== undefined) {
		    	cb = cbA;
		    } else {
		    	// cbA was not passed so do nothing
		    	return true;
		    }

		    type = typeof cb;

		    if (type === 'string') {
		    	// This is for backbone.js support or another routing solution
		    	// if, it is a string, we assume it is a route
		    	if (cb.charAt(0) !== '#') {
		    		// if 
		    		cb = '#' + cb;
		    	}
		    	window.location.hash = cb;
		    	return true;
		    } else if (type === 'function') {
		    	cb();
		    	return true;		    	
		    } else if (type === 'object') {
		    	// look for object and method
		    	if (typeof cb.obj === 'object') {
		    		if (typeof cb.obj[cb.method] === 'function') {
		    			if (cb.params !== undefined) {
		    				cb.obj[cb.method](cb.params);
		    			} else {
		    				cb.obj[cb.method]()
		    			}
		    			return true;
		    		}
		    	}
		    }
		    return false;	    
		};
		
		
	}
	window.AUTH.AB = new AB();
}(window, document, AUTH.ABdata));