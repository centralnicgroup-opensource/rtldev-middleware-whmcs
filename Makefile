ISPAPI_REGISTRAR_MODULE_VERSION := $(shell php -r 'include "registrars/ispapi/ispapi.php"; print $$ispapi_module_version;')

zip:
	@echo $(ISPAPI_REGISTRAR_MODULE_VERSION)

	rm -rf pkg/ispapi_whmcs
	rm -rf pkg/ispapi_whmcs.zip
	mkdir -p pkg/ispapi_whmcs/install/modules/registrars
	mkdir -p pkg/ispapi_whmcs/install/modules/admin
	mkdir -p pkg/ispapi_whmcs/install/modules/widgets
	cp -a registrars/ispapi pkg/ispapi_whmcs/install/modules/registrars
	cp -a admin/ispapi_domain_import pkg/ispapi_whmcs/install/modules/admin
	cp widgets/hexonet_summary.php pkg/ispapi_whmcs/install/modules/widgets
	mv pkg/ispapi_whmcs/install/modules/registrars/ispapi/README.pdf pkg/ispapi_whmcs
	cp README.md HISTORY.md HISTORY.OLD CONTRIBUTING.md LICENSE pkg/ispapi_whmcs
	find pkg/ispapi_whmcs/install -name "*~" | xargs rm -f
	find pkg/ispapi_whmcs/install -name "*.bak" | xargs rm -f
	rm -f pkg/ispapi_whmcs/install/modules/registrars/ispapi/ispapi_whmcs_documentation.odt
	cd pkg && zip -r ispapi_whmcs.zip ispapi_whmcs
	rm -rf pkg/ispapi_whmcs

tar:
	@echo $(ISPAPI_REGISTRAR_MODULE_VERSION)
	
	rm -rf pkg/ispapi_whmcs
	rm -rf pkg/ispapi_whmcs.tar
	mkdir -p pkg/ispapi_whmcs/install/modules/registrars
	mkdir -p pkg/ispapi_whmcs/install/modules/admin
	mkdir -p pkg/ispapi_whmcs/install/modules/widgets
	cp -a registrars/ispapi pkg/ispapi_whmcs/install/modules/registrars
	cp -a admin/ispapi_domain_import pkg/ispapi_whmcs/install/modules/admin
	cp widgets/hexonet_summary.php pkg/ispapi_whmcs/install/modules/widgets
	mv pkg/ispapi_whmcs/install/modules/registrars/ispapi/README.pdf pkg/ispapi_whmcs
	cp README.md HISTORY.md HISTORY.OLD CONTRIBUTING.md LICENSE pkg/ispapi_whmcs
	find pkg/ispapi_whmcs/install -name "*~" | xargs rm -f
	find pkg/ispapi_whmcs/install -name "*.bak" | xargs rm -f
	rm -f pkg/ispapi_whmcs/install/modules/registrars/ispapi/ispapi_whmcs_documentation.odt
	cd pkg && tar -zcvf ispapi_whmcs.tar.gz ispapi_whmcs
	rm -rf pkg/ispapi_whmcs

allarchives:
	@echo $(ISPAPI_REGISTRAR_MODULE_VERSION)
	
	rm -rf pkg/ispapi_whmcs
	rm -rf pkg/ispapi_whmcs.zip
	rm -rf pkg/ispapi_whmcs.tar
	mkdir -p pkg/ispapi_whmcs/install/modules/registrars
	mkdir -p pkg/ispapi_whmcs/install/modules/admin
	mkdir -p pkg/ispapi_whmcs/install/modules/widgets
	cp -a registrars/ispapi pkg/ispapi_whmcs/install/modules/registrars
	cp -a admin/ispapi_domain_import pkg/ispapi_whmcs/install/modules/admin
	cp widgets/hexonet_summary.php pkg/ispapi_whmcs/install/modules/widgets
	mv pkg/ispapi_whmcs/install/modules/registrars/ispapi/README.pdf pkg/ispapi_whmcs
	cp README.md HISTORY.md HISTORY.OLD CONTRIBUTING.md LICENSE pkg/ispapi_whmcs
	find pkg/ispapi_whmcs/install -name "*~" | xargs rm -f
	find pkg/ispapi_whmcs/install -name "*.bak" | xargs rm -f
	rm -f pkg/ispapi_whmcs/install/modules/registrars/ispapi/ispapi_whmcs_documentation.odt
	cd pkg && zip -r ispapi_whmcs.zip ispapi_whmcs && tar -zcvf ispapi_whmcs.tar.gz ispapi_whmcs
	rm -rf pkg/ispapi_whmcs