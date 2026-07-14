// "use strict";
function ThaiNumberToText(Number)
{
	Number = Number.replace (/๐/gi,'0');  
	Number = Number.replace (/๑/gi,'1');  
	Number = Number.replace (/๒/gi,'2');
	Number = Number.replace (/๓/gi,'3');
	Number = Number.replace (/๔/gi,'4');
	Number = Number.replace (/๕/gi,'5');
	Number = Number.replace (/๖/gi,'6');
	Number = Number.replace (/๗/gi,'7');
	Number = Number.replace (/๘/gi,'8');
	Number = Number.replace (/๙/gi,'9');
	return 	ArabicNumberToText(Number);
}

function ArabicNumberToText(Number)
{
	var Number = CheckNumber(Number);
	var NumberArray = new Array ("ສູນ", "ໜື່ງ", "ສອງ", "ສາມ", "ສີ່", "ຫ້າ", "ຫົກ", "ເຈັດ", "ແປດ", "ເກົ້າ", "ສິບ");
	var DigitArray = new Array ("", "ສິບ", "ຮ້ອຍ", "ພັນ", "ໜື່ນ", "ແສນ", "ລ້ານ");
	var BahtText = "";
	if (isNaN(Number))
	{
		return "ຂໍ້ມູນນຳເຂົ້າບໍ່ຖືກຕ້ອງ";
	} else
	{
		if ((Number - 0) > 9999999.9999)
		{
			return "ຂໍ້ມູນນຳເຂົ້າເກີນຂອບເຂດທີຕັ້ງໄວ້";
		} else
		{
			Number = Number.split (".");
			if (Number[1].length > 0)
			{
				Number[1] = Number[1].substring(0, 2);
			}
			var NumberLen = Number[0].length - 0;
			for(var i = 0; i < NumberLen; i++)
			{
				var tmp = Number[0].substring(i, i + 1) - 0;
				if (tmp != 0)
				{
					if ((i == (NumberLen - 1)) && (tmp == 1))
					{
						BahtText += "ໜື່ງ";
					} else
					if ((i == (NumberLen - 2)) && (tmp == 2))
					{
						BahtText += "ຊາວ";
					} else
					if ((i == (NumberLen - 2)) && (tmp == 1))
					{
						BahtText += "";
					} else
					{
						BahtText += NumberArray[tmp];
					}
					BahtText += DigitArray[NumberLen - i - 1];
				}
			}
			BahtText += "ບາດ";
			if ((Number[1] == "0") || (Number[1] == "00"))
			{
				BahtText += "";
			} else
			{
				DecimalLen = Number[1].length - 0;
				for (var i = 0; i < DecimalLen; i++)
				{
					var tmp = Number[1].substring(i, i + 1) - 0;
					if (tmp != 0)
					{
						if ((i == (DecimalLen - 1)) && (tmp == 1))
						{
							BahtText += "ໜື່ງ";
						} else
						if ((i == (DecimalLen - 2)) && (tmp == 2))
						{
							BahtText += "ຊາວ";
						} else
						if ((i == (DecimalLen - 2)) && (tmp == 1))
						{
							BahtText += "";
						} else
						{
							BahtText += NumberArray[tmp];
						}
						BahtText += DigitArray[DecimalLen - i - 1];
					}
				}
				BahtText += "";
			}
			return BahtText;
		}
	}
}

function CheckNumber(Number){
	var decimal = false;
	Number = Number.toString();						
	Number = Number.replace (/ |,|ບາດ|B/gi,'');  		
	for (var i = 0; i < Number.length; i++)
	{
		if(Number[i] =='.'){
			decimal = true;
		}
	}
	if(decimal == false){
		Number = Number+'.00';
	}
	return Number
}