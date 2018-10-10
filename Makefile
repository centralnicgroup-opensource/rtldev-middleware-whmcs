ISPAPI_REGISTRAR_MODULE_VERSION := $(shell php -r 'include "registrars/ispapi/ispapi.php"; print $$ispapi_module_version;')
FOLDER := pkg/ispapi_whmcs-$(ISPAPI_REGISTRAR_MODULE_VERSION)

zip:
	@echo $(ISPAPI_REGISTRAR_MODULE_VERSION);

	rm -rf $(FOLDER)
	rm -rf pkg/ispapi_whmcs.zip
	mkdir -p $(FOLDER)/install/modules/registrars
	mkdir -p $(FOLDER)/install/modules/admin
	mkdir -p $(FOLDER)/install/modules/widgets
	cp -a registrars/ispapi $(FOLDER)/install/modules/registrars
	cp -a admin/ispapi_domain_import $(FOLDER)/install/modules/admin
	cp widgets/hexonet_summary.php $(FOLDER)/install/modules/widgets
	mv $(FOLDER)/install/modules/registrars/ispapi/README.pdf $(FOLDER)
	cp README.md HISTORY.md HISTORY.OLD CONTRIBUTING.md LICENSE $(FOLDER)
	find $(FOLDER)/install -name "*~" | xargs rm -f
	find $(FOLDER)/install -name "*.bak" | xargs rm -f
	rm -f $(FOLDER)/install/modules/registrars/ispapi/ispapi_whmcs_documentation.odt
	cd pkg && zip -r ispapi_whmcs.zip ispapi_whmcs-$(ISPAPI_REGISTRAR_MODULE_VERSION)
	rm -rf $(FOLDER)

tar:
	@echo $(ISPAPI_REGISTRAR_MODULE_VERSION)

	rm -rf $(FOLDER)
	rm -rf pkg/ispapi_whmcs.tar.gz
	mkdir -p $(FOLDER)/install/modules/registrars
	mkdir -p $(FOLDER)/install/modules/admin
	mkdir -p $(FOLDER)/install/modules/widgets
	cp -a registrars/ispapi $(FOLDER)/install/modules/registrars
	cp -a admin/ispapi_domain_import $(FOLDER)/install/modules/admin
	cp widgets/hexonet_summary.php $(FOLDER)/install/modules/widgets
	mv $(FOLDER)/install/modules/registrars/ispapi/README.pdf $(FOLDER)
	cp README.md HISTORY.md HISTORY.OLD CONTRIBUTING.md LICENSE $(FOLDER)
	find $(FOLDER)/install -name "*~" | xargs rm -f
	find $(FOLDER)/install -name "*.bak" | xargs rm -f
	rm -f $(FOLDER)/install/modules/registrars/ispapi/ispapi_whmcs_documentation.odt
	cd pkg && tar -zcvf ispapi_whmcs.tar.gz ispapi_whmcs-$(ISPAPI_REGISTRAR_MODULE_VERSION)
	rm -rf $(FOLDER)

allarchives:
	@echo $(ISPAPI_REGISTRAR_MODULE_VERSION)

	rm -rf $(FOLDER)
	rm -rf pkg/ispapi_whmcs.zip
	rm -rf pkg/ispapi_whmcs.tar
	mkdir -p $(FOLDER)/install/modules/registrars
	mkdir -p $(FOLDER)/install/modules/admin
	mkdir -p $(FOLDER)/install/modules/widgets
	cp -a registrars/ispapi $(FOLDER)/install/modules/registrars
	cp -a admin/ispapi_domain_import $(FOLDER)/install/modules/admin
	cp widgets/hexonet_summary.php $(FOLDER)/install/modules/widgets
	mv $(FOLDER)/install/modules/registrars/ispapi/README.pdf $(FOLDER)
	cp README.md HISTORY.md HISTORY.OLD CONTRIBUTING.md LICENSE $(FOLDER)
	find $(FOLDER)/install -name "*~" | xargs rm -f
	find $(FOLDER)/install -name "*.bak" | xargs rm -f
	rm -f $(FOLDER)/install/modules/registrars/ispapi/ispapi_whmcs_documentation.odt
	cd pkg && zip -r ispapi_whmcs.zip ispapi_whmcs-$(ISPAPI_REGISTRAR_MODULE_VERSION) && tar -zcvf ispapi_whmcs.tar.gz ispapi_whmcs-$(ISPAPI_REGISTRAR_MODULE_VERSION)
	rm -rf $(FOLDER)