// 修改语种价格标点
function resetPrice( str ) {
	if( str === undefined ) {
		return str;
	}
	
	str = str + '';
	
	var priceArr = str.split( '.' );
	
	// 小数点前面的数字
	var p1 = priceArr.length ? priceArr[0] : str,
		
		arr = base.chars.strcut( p1, 3, -1 );
		
	//gvs.langcode
	
	var pointSign = '.';
	// 俄语站为空格
	if( /ru/.test( gvs.langcode ) || gvs.currencycode=='RUB') {
		pointSign = ' ';
	}
	
	// 不进行价格标点转换	
	if( !gvs.isrp ) {
		// 日文不添加  .00
		if( gvs.isjp ) {
			var priceStr = arr.join( '，' ) + ( priceArr.length && priceArr[1] ? '.' + priceArr[1] : '' );
		} else {
			var priceStr = arr.join( ',' ) + ( priceArr.length && priceArr[1] ? pointSign + priceArr[1] : '' );
			//非美元货币设置
			if(gvs.currencycode!="USD" && gvs.currencycode!='RUB'){
				pointSign = ',';
				priceStr = arr.join( '.' ) + ( priceArr.length && priceArr[1] ? pointSign + priceArr[1] : '' );
			}
		}
		//日文货币
		if(gvs.currencycode=='JPY'){
			pointSign = '，';
			
			priceStr = arr.join( '，' ) + ( priceArr.length && priceArr[1] ? pointSign + priceArr[1] : '' );
		}
		if( arr[1] && arr.join( '' ).length < 4 && priceArr.length && priceArr.length < 2 ) {
			if( !/\./.test( priceStr ) ) {
				priceStr += '.00';
			}
		}
		
		priceStr+=' ';	
		return priceStr;
		
	} else {
		
		if( /es/.test( gvs.langcode ) && arr.join( '' ).length < 5 ) {
			pointSign = '';
		}
		
		var priceStr = arr.join( pointSign ) + ( priceArr.length && priceArr[1] ? ',' + priceArr[1] : '' );
		
		if(gvs.currencycode=="USD"){
			priceStr = arr.join( ',' ) + ( priceArr.length && priceArr[1] ? '.' + priceArr[1] : '' );
		}
		//非美元货币设置
		if(gvs.currencycode!="USD" && gvs.currencycode!='RUB'){
			pointSign = ',';
			
			priceStr = arr.join( '.' ) + ( priceArr.length && priceArr[1] ? pointSign + priceArr[1] : '' );
		}
		//日文货币
		if(gvs.currencycode=='JPY'){
			pointSign = '，';
			
			priceStr = arr.join( '，' ) + ( priceArr.length && priceArr[1] ? pointSign + priceArr[1] : '' );
		}
		if( arr.join( '' ).length < 4 && priceArr.length && priceArr.length < 2 ) {
			if( !/,/.test( priceStr ) ) {
				priceStr += ',00';
			}
		}
		
		priceStr+=' ';	
		return priceStr;
	}
}