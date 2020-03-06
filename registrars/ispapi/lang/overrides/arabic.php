<?php
// #########################################################################
// # Add translations for ISPAPI registrar module additional domain fields #
// #########################################################################

// Terms and Conditions Fields, prefixed with hxflagstac
$_LANG["hxflagstacagreement"] = "ألاتفاقية";
$_LANG["hxflagstacagreementindiv"] = "شروط ألاتفاقية للافراد";
$_LANG["hxflagstactrustee"] = "خدمة الحضور المحلية";
$_LANG["hxflagstachighlyregulated"] = "عالي التنظيم - نطاق المستوى الاعلى";
$_LANG["hxflagstachighlyregulateddescrdefault"] = (
    "<div dir='rtl' style='text-align:justify'>".
    "<span style='text-align:right'>"."اختر المربع هنا للتأكد من أن المسجل مؤهل لتسجيل هذا النطاق وأن جميع المعلومات المقدمة صحيحة ودقيقة" . "</span><br><br>".
    "<span style='float:right'>"."يمكن الاطلاع على معايير الأهلية <a href='{TAC}' target='_blank'>هنا</a>."."</span><br>".
    "</div>"
);
$_LANG["hxflagstachighlyregulateddescreco"] = (
    $_LANG["hxflagstachighlyregulateddescrdefault"] .
    "<div dir='rtl' style='text-align:justify; margin-bottom: 10px'>".
    "<br/>سيتم تسجيل جميع أسماء النطاقات .ECO أولاً مع \"server hold \"  لحين استكمال الحد الأدنى لمتطلبات Eco Profile,وتحديداً مسجيل ECO, " .
    "1) مما يؤكد التزامها بسياسة أهلية .ECO 2)حول كيفية إنشاء ملف تعريف Eco التعهد بدعم التغيير الإيجابي للبيئه وأن يكون صادق عند مشاركة المعلومات حول تصرفاتهم. سيتم إرسال التعليمات الى المسجل عن طريق الايميل الالكتروني " .
    ". بمجرد الانتهاء من هذه الخطوات ، سيتم تنشيط نطاق .ECO على الفور بواسطة السجل.".
    "</div>"
);
$_LANG["hxflagstachighlyregulateddescrnotac"] = (
    "حدد لتأكيد <b>الإجراءات الوقائية لنطاقات TLD عالية التنظيم</b>:<br/>" .
    "<div style='text-align:justify'>أنت تفهم وتوافق على أنك ستلتزم بهذه الشروط الإضافية وستتوافق معها:" .
    "<ol><li>معلومات الاتصال الإدارية. أنت توافق على تقديم معلومات الاتصال الإداري ، والتي يجب تحديثها عند التغيير, " .
    " للإبلاغ عن الشكاوى أو تقارير عن إساءة استخدام التسجيل ، فضلاً عن تفاصيل الاتصال بالهيئات التنظيمية ذات الصلة بالعمل في مكان عملها الرئيسي</li>" .
    "<li>أنت تؤكد وتقر بأنك تمتلك أي تصاريح ضرورية ومواثيق و / أو تراخيص و / أو بيانات اعتماد أخرى ذات صلة للمشاركة في القطاع المرتبط بـ TLD..</li>" .
    "<li>تقرير التغييرات التفويض، والمواثيق، التراخيص، وثائق التفويض. أنت توافق على الإبلاغ عن أي تغييرات جوهرية في صلاحية تراخيصك والمواثيق والتراخيص و / أو بيانات الاعتماد الأخرى ذات الصلة للمشاركة في القطاع المرتبط بـ TLD عالي التنظيم لضمان استمرارك في الامتثال التنظيمات ومتطلبات الترخيص عمومًا إجراء أنشطة لك في مصلحة المستهلكين الذين تخدمهم.</li></ol></div>"
);
$_LANG["hxflagstacindividualregulateddescrdefault"] = "حدد لتأكيد <a href='{TAC}' target='_blank'>شروط للأفراد</a>";
$_LANG["hxflagstacregulateddescrdefault"] = "حدد لتأكيد موافقتك على <a href='{TAC}' target='_blank'>شروط وأحكام التسجيل</a> عند تسجيلك الجديد ل {TLD} أسماء النطاقات.";
$_LANG["hxflagstacregulateddescrngo"] = (
    $_LANG["hxflagstacregulateddescrdefault"] .
    "<div style='padding:10px 0px;'>تسجيل {TLD} مع اسم نطاق .ONG دون تكاليف إضافية. " .
    "سيتم تطبيق التغييرات على نطاق {TLD} تلقائيًا على نطاق .ONG. لذلك لن تجد نطاق .ONG مدرجًا في كاتلوك نطاقك.</div>"
);
$_LANG["hxflagstacregulateddescritsection3"] = (
    "<span dir='rtl' style='float:right'>".
    " الرجاء حدد المربع لتأكيد موافقتك على <b><a href='{TAC}' target='_blank'>القسم 3 - تصريحات وافتراضات المسؤولية</a></b>" . "</span><br>".
    "<span style='float:right'>:يعلن مسجل اسم النطاق المعني ، تحت مسؤوليته الخاصة ، أنه</span><br>".
    "<div style='text-align:justify;margin-bottom:10px;clear:both;'>" .
    "<ul dir='rtl'><li>يمتلك الجنسية أو مقيم في بلد ينتمي إلى الاتحاد الأوروبي (في حالة تسجيل الأشخاص الطبيعيين)</li>" .
    "<li >أنشئت في بلد ينتمي إلى الاتحاد الأوروبي (في حالة التسجيل للمنظمات الأخرى)</li>" .
    "<li >تدرك وتقبل أن تسجيل وإدارة اسم النطاق يخضع ل <a href='{TAC}' target='_blank'>'إدارة العمليات المتزامنة على أسماء نطاقات ccTLD {TLD} - المبادئ التوجيهية'</a> " .
    " و <a href='{TAC}' target='_blank'>'حل النزاعات في ccTLD {TLD} - اللوائح والإرشادات'</a> والتعديلات اللاحقة</li>" .
    "<li >يحق له استخدام التوافر القانوني لاسم النطاق الذي تم تقديم طلب له ولا يخل بطلب تسجيل حقوق الآخرين</li>" .
    "<li >تدرك أنه من أجل إدراج البيانات الشخصية في قاعدة بيانات أسماء النطاقات المخصصة ونشرها وإمكانية الوصول إليها عبر الإنترنت ، يجب منح الموافقة عن طريق وضع علامة في المربعات المناسبة في المعلومات أدناه. انظر <a href='{TAC}' target='_blank'>'DBNA and WHOIS Policy'</a></li>" .
    "<li >تدرك وتوافق على أنه في حالة التصريحات الخاطئة في هذا الطلب ، يقوم المسجل على الفور بإلغاء اسم النطاق أو متابعة الإجراءات القانونية الأخرى. في هذه الحالة ، لن يؤدي الإلغاء بأي حال إلى رفع دعوه في المحكمة</li>" .
    "<li >تحرير السجل من أي مسؤولية ناتجة عن تعيين واستخدام اسم المجال من قبل الشخص الذي قدم الطلب</li>" .
    "<li >قبول سلطة القضاء الإيطالي وقوانين الدولة الإيطالية</li></ul>" .
    "</div>"
);
$_LANG["hxflagstacregulateddescritsection5"] = (
    "<span dir='rtl' style='float:right'>"."حدد المربع للتأكيد أنك توافق على <b> <a href='{TAC}' target='_blank'> القسم 5 - الموافقة على معالجة البيانات الشخصية للتسجيل</a></b><br/>" . "</span>".
    "<div dir='rtl' style='text-align:justify;margin-bottom:10px;'>يقوم الطرف المهتم ، بعد قراءة الكشف أعلاه ، بالموافقة على معالجة المعلومات المطلوبة للتسجيل ، على النحو المحدد في الكشف أعلاه. منح الموافقة اختياري ، ولكن إذا لم يتم منح أي موافقة ، فلن يكون من الممكن إنهاء تسجيل اسم النطاق وتعيينه وإدارته.</div>"
);
$_LANG["hxflagstacregulateddescritsection6"] = (
    "<span style='float:right'>"."حدد المربع لتأكيد موافقتك على <a href='{TAC}' target='_blank'> القسم 6 - الموافقة على معالجة البيانات الشخصية للنشر وإمكانية الوصول إليها عبر الإنترنت </a>" . "</span>".
    "<div dir='rtl' style='text-align:justify;margin-bottom:10px;'>الطرف المعني ، بعد قراءة الكشف أعلاه ، يعطي موافقته على النشر وإمكانية الوصول عبر الإنترنت ، على النحو المحدد في الكشف أعلاه. منح الموافقة أمر اختياري ، لكن عدم الموافقة لا يسمح بنشر بيانات الإنترنت والوصول إليها.</div>"
);
$_LANG["hxflagstacregulateddescritsection7"] = (
    "<span dir='rtl' style='float:right'>حدد المربع لتأكيد موافقتك على <a href='{TAC}' target='_blank'> القسم 7 - القبول الصريح بالنقاط التالية </a></span>" .
    "<div dir='rtl' style='text-align:justify;margin-bottom:10px;'>" .
    "للقبول الصريح ، يعلن الطرف المعني أنه:" .
    "<ul><li>يدرك ويوافق على أن تسجيل وإدارة اسم النطاق يخضعان لـ <a href='{TAC}' target='_blank'> قواعد تخصيص وإدارة أسماء النطاقات في ccTLD {TLD} '</a> و <a href='{TAC}' target='_blank'> لوائح حل النزاعات في ccTLD {TLD} '</a> وتعديلاتها اللاحقة</li>" .
    "<li>يدرك ويوافق على أنه في حالة التصريحات الخاطئة في هذا الطلب ، يقوم السجل على الفور بإلغاء اسم النطاق أو متابعة الإجراءات القانونية الأخرى. في هذه الحالة ، لن يؤدي الإلغاء بأي حال إلى رفع دعاوى ضد السجل</li>" .
    "<li>تحرير السجل من أي مسؤولية ناتجة عن تعيين واستخدام اسم المجال من قبل الشخص الطبيعي الذي قدم الطلب</li>" .
    "<li>قبول سلطة القضاء الإيطالية وقوانين الدولة الإيطالية</li></ul>" .
    "</div>"
);

// Generic Fields, prefixed with hxflags
$_LANG["hxflagsyesnoyes"] = "نعم";
$_LANG["hxflagsyesnono"] = "لا";
$_LANG["hxflagsyesnoy"] = "نعم";
$_LANG["hxflagsyesnon"] = "لا";
$_LANG["hxflagsyesno1"] = "نعم";
$_LANG["hxflagsyesno0"] = "لا";

$_LANG["hxflagslegaltype"] = "النوع القانوني";
$_LANG["hxflagslegaltypeindiv"] = "فردي";
$_LANG["hxflagslegaltypeorg"] = "منظمة";
$_LANG["hxflagsintendeduse"] = "غرض الاستخدام";
$_LANG["hxflagsregistrantidnumber"] = "رقم معرف المسجل";
$_LANG["hxflagsregistrantvatid"] = "ID VAT المسجل";
$_LANG["hxflagsadminidnumber"] = "رقم Admin-C ID";
$_LANG["hxflagsadminvatid"] = "Admin-C VAT ID";
$_LANG["hxflagstechidnumber"] = "Tech-C ID رقم";
$_LANG["hxflagstechvatid"] = "Tech-C VAT ID";
$_LANG["hxflagsbillingidnumber"] = "Billing-C ID رقم";
$_LANG["hxflagsregistrantidtype"] = "نوع المسجل ID";
$_LANG["hxflagsallocationtoken"] = "رمز تخصيص التسجيل";
$_LANG["hxflagsallocationtokendescr"] = (
    "لتسجيل نطاق {TLD} ، يجب عليك توفير رمز التخصيص الذي أصدره السجل. يرجى إكمال تطبيق المسجل <a href='{TAC}' target='_blank'> هنا </a> للحصول على الرمز المميز"
);
$_LANG["hxflagsnexuscategory"] = "Nexus فئة";
$_LANG["hxflagsnexuscountry"] = "Nexus بلد";
$_LANG["hxflagsfax"] = "Fax Required";
$_LANG["hxflagsfaxregistrationdescr"] = "أؤكد أنه بعد طلب التسجيل هذا ، سأرسل <a href='{FAXFORM}' target='_blank'> هذا النموذج </a> مرة أخرى لإكمال العملية";
$_LANG["hxflagsfaxtransferdescr"] = "أؤكد أنه بعد طلب النقل هذا ، سأرسل <a href='{FAXFORM}' target='_blank'> هذا النموذج </a> مرة أخرى لإكمال العملية";
$_LANG["hxflagsfaxownerchangedescr"] = "أؤكد أنه بعد هذا الطلب لتغيير المالك ، سأرسل <a href='{FAXFORMggest' target='_blank'> هذا النموذج </a> مرة أخرى لإكمال العملية";
$_LANG["hxflagsidentificationnumber"] = "رقم التعريف ID";
$_LANG["hxflagswhoisoptout"] = "WHOIS Opt-out";
$_LANG["hxflagsregistrantbirthdate"] = "تاريخ ميلاد المسجل";

// AFNIC TLDs, prefixed with hxflagsafnic
$_LANG["hxflagsafnictldvatid"] = "VATID or SIREN/SIRET رقم";
$_LANG["hxflagsafnictldvatiddescr"] = "(فقط للشركات التي لها رقم VATID أو SIREN / SIRET)";
$_LANG["hxflagsafnictldtrademark"] = "رقم العلامة التجارية";
$_LANG["hxflagsafnictldtrademarkdescr"] = "(فقط للشركات ذات العلامة التجارية الأوروبية)";
$_LANG["hxflagsafnictldduns"] = "DUNS رقم ال";
$_LANG["hxflagsafnictlddunsdescr"] = "(فقط للشركات التي لديها رقم DUNS)";
$_LANG["hxflagsafnictldlocalid"] = "ID المحلي";
$_LANG["hxflagsafnictldlocaliddescr"] = "(فقط للشركات ذات المعرف المحلي)";
// French Association, Data from Journal officiel [JO]
$_LANG["hxflagsafnictldjodod"] = "تاريخ الإعلان [JO]";
$_LANG["hxflagsafnictldjododdescr"] = "(فقط للرابطة الفرنسية ، من: <b>YYYY-MM-DD</b>)";
$_LANG["hxflagsafnictldjonumber"] = "رقم [JO]";
$_LANG["hxflagsafnictldjonumberdescr"] = "(فقط للرابطة الفرنسية ، وعدد من المجللات الرسمية)";
$_LANG["hxflagsafnictldjopage"] = "صفحة الإعلان [JO]";
$_LANG["hxflagsafnictldjopagedescr"] = "(فقط للرابطة الفرنسية ، صفحة الإعلان في جورنال أوفيس)";
$_LANG["hxflagsafnictldjodop"] = "Date of Publication [JO]";
$_LANG["hxflagsafnictldjodopdescr"] = "(Only for french association, The date of publication in the Journal Officiel in the form <b>YYYY-MM-DD</b>)";
// Options, Legal Type
$_LANG["hxflagsafnictldlegaltypeindiv"] = "الفردي";
$_LANG["hxflagsafnictldlegaltypeorg1"] = "شركة مع رقم VATID or SIREN/SIRET";
$_LANG["hxflagsafnictldlegaltypeorg2"] = "شركة ذات علامة تجارية أوروبية";
$_LANG["hxflagsafnictldlegaltypeorg3"] = "شركة برقم DUNS";
$_LANG["hxflagsafnictldlegaltypeorg4"] = "معرف الشركة المحلية";
$_LANG["hxflagsafnictldlegaltypeass"] = "الرابطة الفرنسية";

// .AERO
$_LANG["hxflagsaerotldaeroid"] = ".AERO ID <sup style='cursor:help;' title='Obtain from https://www.information.aero/'>ماهذا؟</sup>";
$_LANG["hxflagsaerotldaerokey"] = ".AERO Key <sup style='cursor:help;' title='Obtain from https://www.information.aero/'>ماهذا؟</sup>";

// .CA
$_LANG["hxflagscatldcontactlanguage"] = "لغة الاتصال";
$_LANG["hxflagscatldwhoisoptoutdescr"] = "حدد لإخفاء معلومات الاتصال الخاصة بك في سجل WHOIS (متاح فقط للأفراد ، اقرأ أعلاه.)";
$_LANG["hxflagscatldregistryinformation"] = "معلومات التسجيل";
$_LANG["hxflagscatldregistryinformationdescr"] = (
    "عندما تقوم بتسجيل نطاق {TLD} لأحد المسجلين الجدد (أو تغيير المسجل إلى مجال جديد) ، يتعين على هذا المسجل الجديد الموافقة على اتفاقية المسجل خلال 7 أيام حتى يصبح النطاق نشطًا. خلاف ذلك يتم الحصول على حذف المجال من قبل التسجيل دون أي رد.".
    "<br/><b>في مثل هذه الحالة فقط ، سيتم إرسال رسالة تأكيد بالبريد الإلكتروني إلى المسجل الجديد تغطي الخطوات اللازمة لقبول هذه الاتفاقية.</b><br/>" .
    "إذا تم استخدام جهة اتصال المسجل (المؤكدة بالفعل) لتسجيل نطاق {TLD} آخر ، فسيتم تسجيل النطاق في الوقت الفعلي."
);
// Options, Legal Type
$_LANG["hxflagscatldlegaltypecco"] = "مؤسسة";
$_LANG["hxflagscatldlegaltypecct"] = "المواطن كندي";
$_LANG["hxflagscatldlegaltyperes"] = "المقيم الدائم في كندا";
$_LANG["hxflagscatldlegaltypegov"] = "الحكومة أو الكيان الحكومي في كندا";
$_LANG["hxflagscatldlegaltypeedu"] = "المؤسسة التعليمية الكندية";
$_LANG["hxflagscatldlegaltypeass"] = "الرابطة الكندية غير المسجلة";
$_LANG["hxflagscatldlegaltypehos"] = "المستشفى الكندي";
$_LANG["hxflagscatldlegaltypeprt"] = "شراكة مسجلة في كندا";
$_LANG["hxflagscatldlegaltypetdm"] = "العلامة التجارية المسجلة في كندا (بواسطة مالك غير كندي)";
$_LANG["hxflagscatldlegaltypetrd"] = "الاتحاد التجاري الكندي";
$_LANG["hxflagscatldlegaltypeplt"] = "الحزب السياسي الكندي";
$_LANG["hxflagscatldlegaltypelam"] = "أرشيف المكتبة الكندية أو المتحف";
$_LANG["hxflagscatldlegaltypetrs"] = "تأسيس الثقة في كندا";
$_LANG["hxflagscatldlegaltypeabo"] = "الشعوب الأصلية (أفراد أو مجموعات) من السكان الأصليين في كندا";
$_LANG["hxflagscatldlegaltypeinb"] = "الفرقة الهندية المعترف بها بموجب القانون الهندي لكندا";
$_LANG["hxflagscatldlegaltypelgr"] = "الممثل القانوني للمواطن الكندي أو المقيم الدائم";
$_LANG["hxflagscatldlegaltypeomk"] = "العلامة الرسمية المسجلة في كندا";
$_LANG["hxflagscatldlegaltypemaj"] = "جلالة الملكة";
// Legal Type Description, don't move it up.
$_LANG["hxflagscatldlegaltypedescr"] = (
    "<p>يلتزم السجل الكندي (`CIRA`) بحماية خصوصية المعلومات الشخصية أثناء تشغيله وإدارته لاسم النطاق.</p>" .
    "<p>يعتبر المسجلون الذين يحملون فئات التواجد الكندي التالية أفرادًا:</p>" .
    "<ul>" .
        "<li>" . $_LANG["hxflagscatldlegaltypecct"] . "</li>" .
        "<li>" . $_LANG["hxflagscatldlegaltyperes"] . "</li>" .
        "<li>" . $_LANG["hxflagscatldlegaltypelgr"] . "</li>" .
        "<li>" . $_LANG["hxflagscatldlegaltypeabo"] . "</li>" .
    "</ul>" .
    "<p>تُعتبر جميع الفئات الأخرى مسجِّلين غير فرديين ولا يُسمح لهم بتغيير إعدادات خصوصية WHOIS الخاصة بهم. بالنسبة لبيانات الاتصال لغير الأفراد ، يتم نشرها في WHOIS بواسطة السجل. يمكن للأفراد اتخاذ قرار باستخدام `" . $_LANG["hxflagswhoisoptout"] . "` الحقل أدناه</p>"
);

// .CN
// Options, Registrant ID Type
$_LANG["hxflagscntldregistrantidtypesfz"] = "بطاقة الهوية الصينية";
$_LANG["hxflagscntldregistrantidtypehz"] = "جواز سفر أجنبي";
$_LANG["hxflagscntldregistrantidtypegajmtx"] = "تصريح الدخول والخروج للسفر من وإلى هونج كونج وماكاو";
$_LANG["hxflagscntldregistrantidtypetwjmtx"] = "يسمح لسكان تايوان بالسفر للدخول إلى البر الرئيسي أو الخروج منه";
$_LANG["hxflagscntldregistrantidtypewjlsfz"] = "بطاقة هوية المقيم الدائم الأجنبية";
$_LANG["hxflagscntldregistrantidtypegajzz"] = "تصريح إقامة لسكان هونج كونج / ماكاو";
$_LANG["hxflagscntldregistrantidtypetwjzz"] = "تصريح إقامة لسكان تايوان";
$_LANG["hxflagscntldregistrantidtypejgz"] = "شهادة الضابط الصيني";
$_LANG["hxflagscntldregistrantidtypeorg"] = "شهادة رمز المنظمة الصينية";
$_LANG["hxflagscntldregistrantidtypeyyzz"] = "رخصة تجارية صينية";
$_LANG["hxflagscntldregistrantidtypetydm"] = "شهادة لقانون الائتمان الاجتماعي الموحد";
$_LANG["hxflagscntldregistrantidtypebddm"] = "تعيين الرمز العسكري";
$_LANG["hxflagscntldregistrantidtypejddwfw"] = "رخصة الخدمة الخارجية العسكرية مدفوعة الأجر";
$_LANG["hxflagscntldregistrantidtypesydwfr"] = "شهادة الشخص الاعتباري للمؤسسة العامة";
$_LANG["hxflagscntldregistrantidtypewgczjg"] = "مكاتب تسجيل الممثلين في الشركات الأجنبية";
$_LANG["hxflagscntldregistrantidtypeshttfr"] = "شهادة تسجيل الشخص الاعتباري بالمنظمة الاجتماعية";
$_LANG["hxflagscntldregistrantidtypezjcs"] = "شهادة تسجيل نشاط الدين";
$_LANG["hxflagscntldregistrantidtypembfqy"] = "شهادة تسجيل كيان خاص بخلاف المؤسسات";
$_LANG["hxflagscntldregistrantidtypejjhfr"] = "شهادة تسجيل الشخص الاعتباري في الصندوق";
$_LANG["hxflagscntldregistrantidtypelszy"] = "رخصة مزاولة محاماة";
$_LANG["hxflagscntldregistrantidtypewgzhwh"] = "شهادة تسجيل المركز الثقافي الأجنبي في الصين";
$_LANG["hxflagscntldregistrantidtypewlczjg"] = "مكتب الممثل المقيم لإدارات السياحة لشهادة تسجيل موافقة الحكومة الأجنبية";
$_LANG["hxflagscntldregistrantidtypesfjd"] = "ترخيص الخبرة القضائية";
$_LANG["hxflagscntldregistrantidtypejwjg"] = "شهادة منظمة في الخارج";
$_LANG["hxflagscntldregistrantidtypeshfwjg"] = "شهادة تسجيل وكالة الخدمة الاجتماعية";
$_LANG["hxflagscntldregistrantidtypembxxbx"] = "تصريح مدرسة خاصة";
$_LANG["hxflagscntldregistrantidtypeyljgzy"] = "رخصة مزاولة مهنة الطب";
$_LANG["hxflagscntldregistrantidtypegzjgzy"] = "رخصة ممارسة منظمة كاتب العدل";
$_LANG["hxflagscntldregistrantidtypebjwsxx"] = " تصريح مدرسة بكين للأطفال من موظفي السفارة الأجنبية في الصين";
$_LANG["hxflagscntldregistrantidtypeqt"] = "الآخرين";

// .COM.AU
// Options, Registrant ID Type
$_LANG["hxflagscomautldregistrantidtypeabn"] = "رقم العمل الأسترالي";
$_LANG["hxflagscomautldregistrantidtypeacn"] = "رقم الشركة الأسترالية";
$_LANG["hxflagscomautldregistrantidtyperbn"] = "رقم تسجيل الأعمال";
$_LANG["hxflagscomautldregistrantidtypetm"] = "رقم العلامة التجارية";

// .COM.BR
$_LANG["hxflagscombrtldidentificationnumberdescr"] = "يرجى تقديم أرقام CPF أو CNPJ الصادرة عن دائرة الإيرادات الفيدرالية في البرازيل لأغراض الضرائب";

// .DE
$_LANG["hxflagsdetldgeneralrequestcontact"] = "الاتصال لطلب عام ";
$_LANG["hxflagsdetldabuseteamcontact"] = " فريق اتصال إساءة إستعمال";
$_LANG["hxflagsdetldgeneralrequestcontactdescr"] = "يحدد السجل هذا على أنه معلومات الاتصال بالطلب العام. يمكنك تقديم عنوان بريد إلكتروني أو عنوان url لموقع الويب.";
$_LANG["hxflagsdetldabuseteamcontactdescr"] = "سيعرف السجل هذا على أنه معلومات الاتصال بفريق إساءة الاستخدام. يمكنك تقديم عنوان بريد إلكتروني أو عنوان url لموقع الويب.";

// .DK
$_LANG["hxflagsdktldregistrantcontact"] = "الاتصال بالمسجل";
$_LANG["hxflagsdktldregistrantlegaltype"] = "المسجل النوع القانوني";
$_LANG["hxflagsdktldregistrantvatiddescr"] = "(مطلوب في حالة الخيار الذي تم اختياره `Organization`)";
$_LANG["hxflagsdktldadminvatiddescr"] = "(مطلوب في حالة الخيار الذي تم اختياره `Organization`)";
$_LANG["hxflagsdktldregistrantlegaltypeindiv"] = "فرد";
$_LANG["hxflagsdktldregistrantlegaltypeorg"] = "منظمة";
$_LANG["hxflagsdktldadmincontact"] = "الاتصال الإداري";
$_LANG["hxflagsdktldadminlegaltype"] = "المشرف النوع القانوني";
$_LANG["hxflagsdktldadminlegaltypeindiv"] = "فرد";
$_LANG["hxflagsdktldadminlegaltypeorg"] = "منظمة";
$_LANG["hxflagsdktldlegaltypedescr"] = "اختر أيضًا 'فرد' في حال كنت شركة بدون VATID (سيتم بعد ذلك إلغاء بيانات الشركة في عملية التسجيل).";
$_LANG["hxflagsdktldcontactdescr"] = "DK-HOSTMASTER User ID";

// .ES
$_LANG["hxflagsestldregistranttype"] = "المسجل نوع الاتصال";
$_LANG["hxflagsestldregistrantidentificationnumber"] = "رقم تعريف المسجل";
$_LANG["hxflagsestldadmintype"] = "Admin Contact Type";
$_LANG["hxflagsestldadminidentificationnumber"] = "رقم تعريف جهة اتصال المسؤول";
$_LANG["hxflagsestldregistrantlegaltype"] = "المسجل النوع القانوني";
// Options, Legal Type
$_LANG["hxflagsestldregistrantlegaltype1"] = "فردي";
$_LANG["hxflagsestldregistrantlegaltype39"] = "مجموعة المصالح الاقتصادية";
$_LANG["hxflagsestldregistrantlegaltype47"] = "جمعية";
$_LANG["hxflagsestldregistrantlegaltype59"] = "الاتحاد الرياضي";
$_LANG["hxflagsestldregistrantlegaltype68"] = "الرابطة المهنية";
$_LANG["hxflagsestldregistrantlegaltype124"] = "بنك الادخار";
$_LANG["hxflagsestldregistrantlegaltype150"] = "ممتلكات عامة";
$_LANG["hxflagsestldregistrantlegaltype152"] = "مجتمع المالكين";
$_LANG["hxflagsestldregistrantlegaltype164"] = "أنظباط أو مؤسسة دينية";
$_LANG["hxflagsestldregistrantlegaltype181"] = "قنصلية";
$_LANG["hxflagsestldregistrantlegaltype197"] = "جمعية القانون العام";
$_LANG["hxflagsestldregistrantlegaltype203"] = "السفارة";
$_LANG["hxflagsestldregistrantlegaltype229"] = "السلطة المحلية";
$_LANG["hxflagsestldregistrantlegaltype269"] = "الاتحاد الرياضي";
$_LANG["hxflagsestldregistrantlegaltype286"] = "مؤسسة";
$_LANG["hxflagsestldregistrantlegaltype365"] = "شركة التأمين التعاوني";
$_LANG["hxflagsestldregistrantlegaltype434"] = "الهيئة الحكومية الإقليمية";
$_LANG["hxflagsestldregistrantlegaltype436"] = "هيئة الحكومة المركزية";
$_LANG["hxflagsestldregistrantlegaltype439"] = "حزب سياسي";
$_LANG["hxflagsestldregistrantlegaltype476"] = "اتحاد تجاري";
$_LANG["hxflagsestldregistrantlegaltype510"] = "الشراكة الزراعية";
$_LANG["hxflagsestldregistrantlegaltype524"] = "الشركه العالميه المحدوده";
$_LANG["hxflagsestldregistrantlegaltype525"] = "الاتحاد الرياضي";
$_LANG["hxflagsestldregistrantlegaltype554"] = "المجتمع المدني";
$_LANG["hxflagsestldregistrantlegaltype560"] = "الشراكة العامة";
$_LANG["hxflagsestldregistrantlegaltype562"] = "الشراكة العامة والمحدودة";
$_LANG["hxflagsestldregistrantlegaltype566"] = "تعاوني";
$_LANG["hxflagsestldregistrantlegaltype608"] = "شركة مملوكة للموظف";
$_LANG["hxflagsestldregistrantlegaltype612"] = "شركة محدودة";
$_LANG["hxflagsestldregistrantlegaltype713"] = "المكتب الاسباني";
$_LANG["hxflagsestldregistrantlegaltype717"] = "التحالف المؤقت للمؤسسات";
$_LANG["hxflagsestldregistrantlegaltype744"] = "شركة محدودة مملوكة للموظف";
$_LANG["hxflagsestldregistrantlegaltype745"] = "الكيان العام الإقليمي";
$_LANG["hxflagsestldregistrantlegaltype746"] = "الكيان العام الوطني";
$_LANG["hxflagsestldregistrantlegaltype747"] = "الكيان العام المحلي";
$_LANG["hxflagsestldregistrantlegaltype878"] = "تسمية مجلس الإشراف على المنشأ";
$_LANG["hxflagsestldregistrantlegaltype879"] = "كيان إدارة المناطق الطبيعية";
$_LANG["hxflagsestldregistrantlegaltype877"] = "اخر";
// Options, Registrant ID Type
$_LANG["hxflagsestldregistranttype0"] = "لمالك غير إسباني";
$_LANG["hxflagsestldregistranttype1"] = "لفرد أو منظمة أسبانية";
$_LANG["hxflagsestldregistranttype3"] = "بطاقة تسجيل الأجنبي";
$_LANG["hxflagsestldadmintype0"] = "للكيان غير الأسباني";
$_LANG["hxflagsestldadmintype1"] = "لفرد أو منظمة أسبانية";
$_LANG["hxflagsestldadmintype3"] = "بطاقة تسجيل الأجنبي";

// .EU
$_LANG["hxflagseutldregistrantcitizenship"] = "جنسية المسجل";
$_LANG["hxflagseutldregistrantcitizenshipdescr"] = "مطلوب فقط إذا كنت مواطنًا أوروبيًا مقيمًا خارج الاتحاد الأوروبي";

// .FI
$_LANG["hxflagsfitldregistrantidnumberdescr"] = (
    "<ul><li>الشركات: يرجى تقديم رقم التسجيل</li>" .
    "<li>الأفراد من فنلندا: تقديم رقم الهوية</li>" .
    "<li>الأفراد الآخرون: اتركوها فارغة</li></ul>" .
    "بالنسبة للأفراد ، يرجى ملاحظة أن X-FI-REGISTRANT-IDNUMBER يجب أن تحتوي على أحد عشر حرفًا من النموذج DDMMYYCZZZQ ، حيث DDMMYY هو تاريخ الميلاد ، C علامة القرن ، ZZZ الرقم الفردي و Q حرف التحكم (المجموع الاختباري) . علامة القرن هي + (1800-1899) ، - (1900-1999) ، أو A (2000-2099). الرقم الفردي ZZZ غريب بالنسبة للذكور وحتى بالنسبة للإناث وللأشخاص المولودين في فنلندا ، يتراوح مداها بين 002-899 (يمكن استخدام أعداد أكبر في حالات خاصة). مثال على رمز صالح هو 311280-888Y."
);
$_LANG["hxflagsfitldregistrantbirthdatedescr"] = "(YYYY-MM-DD; مطلوب فقط للأفراد ليس من فنلندا)";

// .HK
$_LANG["hxflagshktldregistrantdocumenttype"] = "نوع وثيقة المسجل ";
$_LANG["hxflagshktldregistrantotherdocumenttype"] = "نوع الوثيقة الأخرى للمسجل";
$_LANG["hxflagshktldregistrantdocumentnumber"] = "رقم وثيقة المسجل";
$_LANG["hxflagshktldregistrantdocumentorigincountry"] = "وثيقة بلد المنشأ للمسجل";
$_LANG["hxflagshktldregistrantbirthdateforindividuals"] = "تاريخ الميلاد المسجل للأفراد";
// Options, Registrant Document Type
$_LANG["hxflagshktldregistrantdocumenttypehkid"] = "الافراد - رقم هوية هونج كونج";
$_LANG["hxflagshktldregistrantdocumenttypeothid"] = "الافراد - رقم هوية البلد الآخر";
$_LANG["hxflagshktldregistrantdocumenttypepassno"] = "الافراد - رقم جواز السفر";
$_LANG["hxflagshktldregistrantdocumenttypebirthcert"] = "شهادة الميلاد الفردية";
$_LANG["hxflagshktldregistrantdocumenttypeothidv"] = "الافراد - أخرى وثيقة فردية";
$_LANG["hxflagshktldregistrantdocumenttypebr"] = "المنظمة - شهادة تسجيل الأعمال";
$_LANG["hxflagshktldregistrantdocumenttypeci"] = "المنظمة - شهادة التأسيس";
$_LANG["hxflagshktldregistrantdocumenttypecrs"] = "منظمة - شهادة تسجيل مدرسة";
$_LANG["hxflagshktldregistrantdocumenttypehksarg"] = "منظمة - حكومة منطقة هونغ كونغ الإدارية الخاصة";
$_LANG["hxflagshktldregistrantdocumenttypehkordinance"] = "منظمة - مرسوم هونغ كونغ";
$_LANG["hxflagshktldregistrantdocumenttypeothorg"] = "منظمة - وثيقة منظمة أخرى";
$_LANG["hxflagshktldregistrantdocumenttypedescr"] = (
    "(ملاحظة: بالإضافة إلى ذلك ، قد تحتاج إلى إرسال نسخة من المستند إلينا عبر البريد الإلكتروني. بالنسبة لـ .HK ، هذه الخطوة مطلوبة فقط بناءً على طلب التسجيل. بالنسبة إلى .COM.HK ، يلزم الحصول على نسخة من شهادة العمل قبل أن نتمكن من معالجة التسجيل.)"
);
$_LANG["hxflagshktldregistrantotherdocumenttypedescr"] = "(مطلوب لأنواع مستندات المسجل `وثيقة فردية / منظمة أخرى)";
$_LANG["hxflagshktldregistrantbirthdateforindividualsdescr"] = "(إلزامي للأفراد, بالصيغه YYYY-MM-DD)";

// .IE
$_LANG["hxflagsietldregistrantclass"] = "تصنيف المسجل";
$_LANG["hxflagsietldproofofconnectiontoireland"] = "دليل على اتصال أيرلندا";
$_LANG["hxflagsietldproofofconnectiontoirelanddescr"] = (
    "قدم أي معلومات تدعم طلب التسجيل الخاص بك ، مثل إثبات الأهلية (مثل ضريبة القيمة المضافة أو RBN أو CRO أو CHY أو NIC أو رقم العلامة التجارية أو رقم السجل المدرسي أو رابط إلى صفحة الوسائط الاجتماعية) أو شرح موجز عن سبب رغبتك في هذا المجال وفي ماذا سوف تستخدمه."
);
// Options, Registrant Class
$_LANG["hxflagsietldregistrantclasscompany"] = "شركة";
$_LANG["hxflagsietldregistrantclassbusinessowner"] = "صاحب العمل";
$_LANG["hxflagsietldregistrantclassclubbandlocalgroup"] = "النادي / الفرقة / المجموعة المحلية";
$_LANG["hxflagsietldregistrantclassschoolcollege"] = "مدرسة / كلية";
$_LANG["hxflagsietldregistrantclassstateagency"] = "وكالة دولية";
$_LANG["hxflagsietldregistrantclasscharity"] = "مؤسسة خيرية";
$_LANG["hxflagsietldregistrantclassbloggerother"] = "مدون / أخرى";

// .IT
$_LANG["hxflagsittldpin"] = "PIN";
$_LANG["hxflagsittldacceptsection3"] = "القسم 3 من عقد مسجل IT";
$_LANG["hxflagsittldacceptsection5"] = "القسم 5 من عقد مسجل IT";
$_LANG["hxflagsittldacceptsection6"] = "القسم 6 من. عقد المسجل";
$_LANG["hxflagsittldacceptsection7"] = "القسم 7 من .IT عقد المسجل";
$_LANG["hxflagsittldregistrantnationality"] = "جنسية المسجل";
$_LANG["hxflagsittldregistrantnationalitydescr"] = "(جنسية جهة اتصال المسجل إذا كانت تختلف عن رمز البلد.)";
$_LANG["hxflagsittldregistrantlegaltype"] = "النوع القانوني للمسجل";
$_LANG["hxflagsittldregistrantlegaltype1"] = "[1] الأشخاص الطبيعيين الإيطاليين والأجانب";
$_LANG["hxflagsittldregistrantlegaltype2"] = "[2] الشركات الإيطالية / شركات رجل واحد";
$_LANG["hxflagsittldregistrantlegaltype3"] = "[3] عمال ايطاليين لحسابهم الخاص / المهنيين";
$_LANG["hxflagsittldregistrantlegaltype4"] = "[4] المنظمات غير الربحية الايطالية";
$_LANG["hxflagsittldregistrantlegaltype5"] = "[5] المنظمات العامة الإيطالية";
$_LANG["hxflagsittldregistrantlegaltype6"] = "[6] الموضوعات الإيطالية الأخرى";
$_LANG["hxflagsittldregistrantlegaltype7"] = "[7] منظمة دولة أخرى عضو في الاتحاد الأوروبي (مطابقة 2 - 6)";

// .JOBS
$_LANG["hxflagsjobstldyesnono"] = "لا";
$_LANG["hxflagsjobstldyesnoyes"] = "نعم";
$_LANG["hxflagsjobstldwebsite"] = "موقع";
$_LANG["hxflagsjobstldindustryclassification"] = "تصنيف الصناعة";
$_LANG["hxflagsjobstldmemberofahrassociation"] = "عضو في جمعية الموارد البشرية";
$_LANG["hxflagsjobstldcontactjobtitle"] = "عنوان الوظيفة (على سبيل المثال الرئيس التنفيذي)";
$_LANG["hxflagsjobstldcontacttype"] = "نوع الاتصال";
// Options, Industry Classification
$_LANG["hxflagsjobstldindustryclassification2"] = "المحاسبة / المصرفية / المالية";
$_LANG["hxflagsjobstldindustryclassification3"] = "علم الزراعة / الزراعة";
$_LANG["hxflagsjobstldindustryclassification21"] = "التكنولوجيا الحيوية / العلوم";
$_LANG["hxflagsjobstldindustryclassification5"] = "الكمبيوتر / تكنولوجيا المعلومات";
$_LANG["hxflagsjobstldindustryclassification4"] = "البناء / خدمات البناء";
$_LANG["hxflagsjobstldindustryclassification12"] = "مستشار";
$_LANG["hxflagsjobstldindustryclassification6"] = "التعليم / التدريب / مكتبة";
$_LANG["hxflagsjobstldindustryclassification7"] = "وسائل الترفيه";
$_LANG["hxflagsjobstldindustryclassification13"] = "بيئي";
$_LANG["hxflagsjobstldindustryclassification19"] = "حسن الضيافة";
$_LANG["hxflagsjobstldindustryclassification10"] = "الحكومة / الخدمة المدنية";
$_LANG["hxflagsjobstldindustryclassification11"] = "رعاية صحية";
$_LANG["hxflagsjobstldindustryclassification15"] = "توظيف / موارد بشرية";
$_LANG["hxflagsjobstldindustryclassification16"] = "تأمين";
$_LANG["hxflagsjobstldindustryclassification17"] = "قانوني";
$_LANG["hxflagsjobstldindustryclassification18"] = "تصنيع";
$_LANG["hxflagsjobstldindustryclassification20"] = "وسائل الإعلام / إعلان";
$_LANG["hxflagsjobstldindustryclassification9"] = "الحدائق والترفيه";
$_LANG["hxflagsjobstldindustryclassification26"] = "الأدوية";
$_LANG["hxflagsjobstldindustryclassification22"] = "العقارات";
$_LANG["hxflagsjobstldindustryclassification14"] = "مطعم / خدمة الغذاء";
$_LANG["hxflagsjobstldindustryclassification23"] = "قطاعي";
$_LANG["hxflagsjobstldindustryclassification8"] = "التسويق عبر الهاتف";
$_LANG["hxflagsjobstldindustryclassification24"] = "وسائل النقل";
$_LANG["hxflagsjobstldindustryclassification25"] = "اخرى";
// Options, Contact Type
$_LANG["hxflagsjobstldcontacttype1"] = "إداري";
$_LANG["hxflagsjobstldcontacttype0"] = "اخرى";

// .LOTTO
$_LANG["hxflagslottotldmembershipcontactid"] = "عضوية الاتصال ID";
$_LANG["hxflagslottotldverificationcode"] = "كود التفعيل";

// .LT
$_LANG["hxflagslttldlegalentityidentificationcode"] = "كود تحديد الكيان القانوني";

// .MELBOURNE
// Options, Nexus Category
$_LANG["hxflagsmelbournetldnexuscategorya"] = "الكيانات الفيكتورية";
$_LANG["hxflagsmelbournetldnexuscategoryb"] = "سكان فيكتوريا";
$_LANG["hxflagsmelbournetldnexuscategoryc"] = "الكيانات المرتبطة";
$_LANG["hxflagsmelbournetldnexuscategorydescr"] = (
    "<div dir='rtl' style='padding:10px 0px;text-align:justify'><b>أهلية التسجيل</b><br/>للتسجيل أو تجديد اسم النطاق ، يجب على مقدم الطلب أو المسجل استيفاء أحد المعايير التالية A أو B أو C أدناه:<br/><br/>".
    "<b>المعيار A - الكيانات الفيكتورية</b><br/>يجب أن يكون مقدم الطلب كيانًا مسجلاً في `<a href='https://asic.gov.au/' target='_blank'> هيئة الأوراق المالية والاستثمارات الأسترالية</a>` أو `<a href='https://register.business.gov.au/' target='_blank'>سجل الأعمال الأسترالي</a>` الذي:<ul>" .
    "<li>لديه عنوان في ولاية فيكتوريا يرتبط بـ ABN أو ACN أو RBN أو ARBN ؛ أو</li>".
    "<li>لديه عنوان شركة صالح في ولاية فيكتوريا</li>".
    "</ul><br/>".
    "<b>المعيار B - سكان فيكتوريا</b><br/>يجب أن يكون مقدم الطلب مواطنًا أستراليًا أو مقيمًا له عنوان صالح في ولاية فيكتوريا<br/><br/>" .
    "<b>المعيار C - الكيانات المرتبطة</b><br/>يجب أن يكون مقدم الطلب كيانًا مشاركًا. لا يجوز لمقدم الطلب التقدم إلا للحصول على اسم نطاق مطابق تمامًا أو مطابقة جزئية لـ ، أو اختصار ، أو اختصار لـ:" .
    "<ul><li>الاسم التجاري لمقدم الطلب ، أو الاسم الذي يُعرف به مقدم الطلب عمومًا (أي اسم مستعار) ، ويجب تسجيل اسم النشاط التجاري بالسلطة المناسبة في الولاية القضائية التي يقع فيها مقر النشاط التجاري ؛ أو</li>" .
    "<li>منتج تقوم الجهة المرتبطة بتصنيعه أو بيعه لكيانات أو أفراد مقيمين في ولاية فيكتوريا ؛</li>".
    "<li>خدمة يقدمها الكيان المرتبط لسكان ولاية فيكتوريا ؛</li>" .
    "<li>حدث ينظمه الكيان المرتبط أو يرعى في ولاية فيكتوريا ؛</li>" .
    "<li>نشاط ييسره الكيان المرتبط في ولاية فيكتوريا ؛ أو</li>" .
    "<li>دورة أو برنامج تدريبي يوفره الكيان المرتبط لسكان ولاية فيكتوريا</li></div>"
);

// .MY
$_LANG["hxflagsmytldregistrantorganisationtype"] = "نوع منظمة المسجل";
// Options, Registrant Organisation Type
$_LANG["hxflagsmytldregistrantorganisationtype1"] = "شركة المعماري";
$_LANG["hxflagsmytldregistrantorganisationtype2"] = "شركة مراجعة الحسابات";
$_LANG["hxflagsmytldregistrantorganisationtype3"] = "العمل وفقًا لقانون تسجيل الأعمال (rob)";
$_LANG["hxflagsmytldregistrantorganisationtype4"] = "العمل بموجب مرسوم الترخيص التجاري";
$_LANG["hxflagsmytldregistrantorganisationtype5"] = "شركة وفقا لقانون الشركات (ROC)";
$_LANG["hxflagsmytldregistrantorganisationtype6"] = "مؤسسة تعليمية معتمدة / مسجلة من قبل الإدارة / الوكالة الحكومية ذات الصلة";
$_LANG["hxflagsmytldregistrantorganisationtype7"] = "منظمة المزارعين";
$_LANG["hxflagsmytldregistrantorganisationtype8"] = "إدارة أو وكالة حكومية اتحادية";
$_LANG["hxflagsmytldregistrantorganisationtype9"] = "سفارة اجنبية";
$_LANG["hxflagsmytldregistrantorganisationtype10"] = "مكتب خارجي";
$_LANG["hxflagsmytldregistrantorganisationtype11"] = "المدارس الابتدائية و / أو الثانوية التي تدعمها الحكومة";
$_LANG["hxflagsmytldregistrantorganisationtype12"] = "مكتب محاماة";
$_LANG["hxflagsmytldregistrantorganisationtype13"] = "ليمباجا (مجلس)";
$_LANG["hxflagsmytldregistrantorganisationtype14"] = "إدارة أو وكالة السلطة المحلية";
$_LANG["hxflagsmytldregistrantorganisationtype15"] = "maktab rendah sains mara (mrsm) تحت إدارة mara";
$_LANG["hxflagsmytldregistrantorganisationtype16"] = "وزارة الدفاع دائره أو وكالة";
$_LANG["hxflagsmytldregistrantorganisationtype17"] = "شركة خارجية";
$_LANG["hxflagsmytldregistrantorganisationtype18"] = "جمعية المعلمين الآباء";
$_LANG["hxflagsmytldregistrantorganisationtype19"] = "كلية الفنون التطبيقية التابعة لوزارة التعليم";
$_LANG["hxflagsmytldregistrantorganisationtype20"] = "مؤسسة التعليم العالي الخاصة";
$_LANG["hxflagsmytldregistrantorganisationtype21"] = "مدرسة خاصة";
$_LANG["hxflagsmytldregistrantorganisationtype22"] = "المكتب الاقليمي";
$_LANG["hxflagsmytldregistrantorganisationtype23"] = "كيان ديني";
$_LANG["hxflagsmytldregistrantorganisationtype24"] = "مكتب الممثل";
$_LANG["hxflagsmytldregistrantorganisationtype25"] = "المجتمع بموجب قانون المجتمعات (ros)";
$_LANG["hxflagsmytldregistrantorganisationtype26"] = "منظمة رياضية";
$_LANG["hxflagsmytldregistrantorganisationtype27"] = "إدارة حكومة الولاية أو الوكالة";
$_LANG["hxflagsmytldregistrantorganisationtype28"] = "اتحاد تجاري";
$_LANG["hxflagsmytldregistrantorganisationtype29"] = "الوصي";
$_LANG["hxflagsmytldregistrantorganisationtype30"] = "جامعة تحت إدارة وزارة التعليم";
$_LANG["hxflagsmytldregistrantorganisationtype31"] = "مثمن ، مخمن ، شركة الوكيل العقاري";

// .NYC
// Options, Nexus Category
$_LANG["hxflagsnyctldnexuscategory1"] = "الشخص الطبيعي - الموطن الرئيسي مع عنوان فعلياً في مدينة نيويورك";
$_LANG["hxflagsnyctldnexuscategory2"] = "الكيان أو المنظمة - الموطن الرئيسي مع عنوان فعلياً في مدينة نيويورك";
$_LANG["hxflagsnyctldnexuscategorydescr"] = "(P.O Boxes are prohibited, see <a href='{TAC}' target='_blank'>سياسات NYC Nexus</a>)";

// .PRO
$_LANG["hxflagsprotldprofession"] = "مهنة";
$_LANG["hxflagsprotldlicensenumber"] = "رقم الرخصة";
$_LANG["hxflagsprotldauthority"] = "السلطة";
$_LANG["hxflagsprotldauthoritywebsite"] = "موقع السلطة";

// .PT
$_LANG["hxflagspttldroid"] = "ROID";

// .RO
$_LANG["hxflagsrotldregistrantvatiddescr"] = "(مطلوبة لدول الاتحاد الأوروبي والمسجلين الرومانية)";

// .RU
$_LANG["hxflagsrutldlegaltypeindiv"] = "فردي";
$_LANG["hxflagsrutldlegaltypeorg"] = "منظمة";
$_LANG["hxflagsrutldregistrantbirthday"] = "عيد ميلاد الأفراد";
$_LANG["hxflagsrutldregistrantbirthdaydescr"] = "(مطلوب للأفراد)";
$_LANG["hxflagsrutldregistrantpassportdata"] = "بيانات جواز السفر للأفراد";
$_LANG["hxflagsrutldregistrantpassportdatadescr"] = "(مطلوب للأفراد ؛ بما في ذلك رقم جواز السفر وتاريخ الإصدار ومكان الإصدار)<br/><br/>";

// .SE
$_LANG["hxflagssetldidentificationnumberdescr"] = (
    "<div style='text-align:justify'><b>للأفراد أو الشركات الموجودة في السويد</b>يجب ذكر رقم شخصي أو تنظيمي سويدي فعال.<br/>" .
    "<b>للأفراد والشركات خارج السويد</b>يجب ذكر رقم الهوية (مثل رقم التسجيل المدني أو رقم تسجيل الشركة أو ما يعادلها).</div>"
);

// .SG
$_LANG["hxflagssgtldrcbsingaporeid"] = "RCB Singapore ID";

// .SWISS
$_LANG["hxflagsswisstldregistrantenterpriseid"] = "رقم ID المؤسسة المسجل";
$_LANG["hxflagsswisstldregistrantenterpriseiddescr"] = "(يجب أن تبدأ بـ CHE متبوعة بـ 9 أرقام)";

// .SYDNEY
// Options, Nexus Category
$_LANG["hxflagssydneytldnexuscategorya"] = "المعيار A - كيانات نيو ساوث ويلز";
$_LANG["hxflagssydneytldnexuscategoryb"] = "المعيار B - سكان نيو ساوث ويلز";
$_LANG["hxflagssydneytldnexuscategoryc"] = "المعيار C - الكيانات المرتبطة";
$_LANG["hxflagssydneytldnexuscategorydescr"] = (
    "للتسجيل أو تجديد اسم نطاق {TLD} ، يجب على مقدم الطلب أو المسجل استيفاء أحد المعايير التالية A أو B أو C أدناه:<br/><br/>" .
    "<b>المعيار A - كيانات نيو ساوث ويلز</b><br/>" .
    "يجب أن يكون مقدم الطلب كيانًا مسجلًا لدى هيئة الأوراق المالية والاستثمارات الأسترالية أو سجل الأعمال الأسترالي:<br/>" .
    "لديه عنوان في ولاية نيو ساوث ويلز مرتبط بـ ABN أو ACN أو RBN أو ARBN ؛ أو لديه عنوان صالح للشركة في ولاية نيو ساوث ويلز<br/>" .
    "<b>المعيار B - سكان نيو ساوث ويلز</b><br/>" .
    "يجب أن يكون مقدم الطلب مواطنًا أستراليًا أو مقيمًا له عنوان صالح في ولاية نيو ساوث ويلز.<br/>" .
    "<b>المعيار C - الكيانات المرتبطة</b><br/>" .
    "يجب أن يكون مقدم الطلب كيانًا مشاركًا. لا يجوز لمقدم الطلب التقدم إلا للحصول على اسم مجال مطابق تمامًا أو مطابقة جزئية لـ ، أو اختصار لـ:<br/>" .
    "الاسم التجاري لمقدم الطلب ، أو الاسم الذي يعرف به مقدم الطلب عادة (أي الاسم المستعار) ويجب تسجيل اسم النشاط التجاري لدى السلطة المختصة في" .
    "الاختصاص القضائي الذي يقع فيه النشاط التجاري ؛ أو منتجًا يقوم الكيان المرتبط بتصنيعه أو بيعه لكيانات أو أفراد مقيمين في ولاية نيو ساوث ويلز ؛" .
    "خدمة يقدمها الكيان المرتبط لسكان ولاية نيو ساوث ويلز ؛ حدث ينظمه الكيان المرتبط أو يرعى في ولاية نيو ساوث ويلز ؛" .
    "نشاط ييسره الكيان المرتبط في ولاية نيو ساوث ويلز ؛ أو دورة أو برنامج تدريبي يوفره الكيان المرتبط لسكان ولاية نيو ساوث ويلز."
);

// .TRAVEL
$_LANG["hxflagstraveltldtravelindustry"] = "المتعلقة بقطاع السفر";
$_LANG["hxflagstraveltldtravelindustrydescr"] = "(نحن نعترف بوجود علاقة بقطاع السفر وأننا نشارك أو نخطط للمشاركة في الأنشطة المتعلقة بالسفر.)";
$_LANG["hxflagstraveltldyesno1"] = "نعغم";
$_LANG["hxflagstraveltldyesno0"] = "لا";

// .US
// Options, Intended Use
$_LANG["hxflagsustldintendedusep1"] = "استخدام العمل من أجل الربح";
$_LANG["hxflagsustldintendedusep2"] = "مؤسسة غير ربحية / نادي / جمعية / منظمة دينية";
$_LANG["hxflagsustldintendedusep3"] = "استخدام شخصي";
$_LANG["hxflagsustldintendedusep4"] = "أغراض تعليمية";
$_LANG["hxflagsustldintendedusep5"] = "أغراض الحكومة";
// Options, Nexus Category, https://www.about.us/policies/ustld-nexus-codes
$_LANG["hxflagsustldnexuscategoryc11"] = "[C11] شخص طبيعي وهو مواطن أمريكي";
$_LANG["hxflagsustldnexuscategoryc12"] = "[C12] شخص طبيعي مقيم دائمًا في الولايات المتحدة الأمريكية أو أي من ممتلكاته";
$_LANG["hxflagsustldnexuscategoryc21"] = "[C21] منظمة أو شركة مقرها الولايات المتحدة ؛ موضحه بالتفصيل أدناه";
$_LANG["hxflagsustldnexuscategoryc31"] = "[C31] كيان أو منظمة أجنبية ؛ موضحه بالتفصيل أدناه";
$_LANG["hxflagsustldnexuscategoryc32"] = "[C32] كيان أجنبي لديه مكتب أو منشآت أخرى في الولايات المتحدة";
$_LANG["hxflagsustldnexuscategorycdescr"] = (
    "<ul>".
    "<li>[C21]: منظمة أو شركة مقرها الولايات المتحدة تشكلت في واحدة من خمسين ولاية أمريكية (50) ، أو مقاطعة كولومبيا ، أو أي من ممتلكات أو أقاليم الولايات المتحدة ؛ أو نظمت أو تشكلت بطريقة أخرى بموجب قوانين ولاية في الولايات المتحدة الأمريكية ، أو مقاطعة كولومبيا أو أي من ممتلكاتها أو أقاليمها أو كيان حكومي فيدرالي أو ولاية أو حكومة محلية أو أحد أقسامها السياسية</li>" .
    "<li>[C31]: كيان أو منظمة أجنبية لها وجود حسن النية في الولايات المتحدة الأمريكية أو أي من ممتلكاتها أو أقاليمها التي تمارس بانتظام أنشطة / مبيعات قانونية للسلع أو الخدمات أو غيرها من الأعمال التجارية أو غير التجارية ، بما في ذلك غير علاقات ربحية في الولايات المتحدة</li></ul>"
);
$_LANG["hxflagsustldnexuscountrydescr"] = "<div>حدد الجنسية الأصلية للمسجِّل (في حالة الخيارين الأخيرين من فئة Nexus (C31 أو C32)).</div>";

// .XXX
$_LANG["hxflagsxxxtldnonresolvingdomain"] = "مجال غير ممكن حله";
$_LANG["hxflagsxxxtldmembershipid"] = ".XXX ID العضوية";
$_LANG["hxflagsxxxtldmembershipiddescr"] = "(مطلوب لحل النطاق .XXX الخاص بك)";
// Options, Non-Resolving Domain
$_LANG["hxflagsxxxtldnonresolvingdomain0"] = "لا - يجب حل هذا المجال";
$_LANG["hxflagsxxxtldnonresolvingdomain1"] = "نعم - لا يجب حل هذا المجال";

// ----------------------------------------------------------------------
// ----------------------- OWNER CHANGE ---------------------------------
// ----------------------------------------------------------------------
$_LANG["hxtraderequestedsuccessfully"] = "تم طلب التجارة بنجاح";
$_LANG["hxownerchangeproceduresimple"] = "يتطلب تغيير المسجل لهذا TLD إجراءً خاصًا يسمى 'التجارة'. سيتم استبدال الاتصال المسجل.";
$_LANG["hxownerchangeprocedureextended"] = "يتطلب تغيير المسجل لهذا TLD إجراءً خاصًا يسمى 'التجارة'. سيتم استبدال المسجل والاتصال المسؤول.";
$_LANG["hxownerchange"] = "تغيير المسجل";
$_LANG["hxbttnsendtrade"] = "إرسال التجارة";
$_LANG["hxerrormissingfields"] = "البيانات المفقودة للحقول الإلزامية أدناه:";

// ----------------------------------------------------------------------
// ----------------------- WHOIS PRIVACY --------------------------------
// ----------------------------------------------------------------------
$_LANG["hxwhoisprivacy"] = "خصوصية WHOIS";
$_LANG["hxwhoisprivacyrequestsuccess"] = "تم تطبيق تغييرات خدمة خصوصية WHOIS بنجاح.";
$_LANG["hxwhoisprivacywhy"] = "أهمية خصوصية WHOIS";
$_LANG["hxwhoisprivacyreason"] = (
    "يتطلب تسجيل اسم النطاق توفير معلومات الاتصال الشخصية للتخزين الدائم الذي تديره خوادم الجهة الخارجية لـ WHOIS. هذا يعني أن اسمك وعنوانك ورقم هاتفك والبريد الإلكتروني يتم تسجيلها والاحتفاظ بها من قبل أطراف ثالثة دون قيود. تقدم بعض السجلات خدمة الخصوصية لـ WHOIS الخاصة بها مجانًا والتي تتيح حماية بيانات WHOIS من جميع الأطراف الثالثة."
);
$_LANG["hxwhoisprivacystatus"] = "حالة خصوصية WHOIS";
$_LANG["hxwhoisprivacystatus1"] = "معلومات WHOIS لديك محمية حاليًا";
$_LANG["hxwhoisprivacystatus0"] = "معلومات WHOIS الخاصة بك غير محمية في الوقت الحالي";
$_LANG["hxwhoisprivacystatusnp"] = "خدمة خصوصية WHOIS متاحة فقط للأفراد";
$_LANG["hxwhoisprivacybttnenable"] = "تمكين خصوصية WHOIS";
$_LANG["hxwhoisprivacybttndisable"] = "تعطيل خصوصية WHOIS";

// ----------------------------------------------------------------------
// ----------------------- DNSSEC MANAGEMENT ----------------------------
// ----------------------------------------------------------------------
$_LANG["hxdnssecmanagement"] = "إدارة DNSSEC";
