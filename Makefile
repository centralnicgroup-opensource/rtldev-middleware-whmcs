VERSION := $(shell node -p "require('./release.json').version")
REPOID := whmcs-ispapi-registrar
FOLDER := pkg/$(REPOID)-$(VERSION)
MODFOLDER := $(FOLDER)/install/modules/registrars/ispapi
LIBFOLDER := $(MODFOLDER)/lib
SDKFOLDER := $(LIBFOLDER)/sdk
DOCFOLDER := $(FOLDER)/docs

clean:
	rm -rf $(FOLDER)

buildsources:
	# create archive folder structure
	mkdir -p $(DOCFOLDER)
	mkdir -p $(FOLDER)/install/modules/registrars
	# clone repository wiki
	rm -rf /tmp/$(REPOID)
	git clone https://github.com/hexonet/$(REPOID).wiki.git /tmp/$(REPOID)
	# Copy files (archive contents)
	cp -a registrars/ispapi $(FOLDER)/install/modules/registrars
	cp README.md HISTORY.md HISTORY.old CONTRIBUTING.md LICENSE /tmp/$(REPOID)/*.md $(DOCFOLDER)
	# Clean up files
	rm -rf $(MODFOLDER)/migration rm -rf $(MODFOLDER)/hooks_migration.php /tmp/$(REPOID)
	rm -rf $(DOCFOLDER)/_*.md $(DOCFOLDER)/Home.md $(DOCFOLDER)/Start-Reselling-with-HEXONET-over-WHMCS.md $(DOCFOLDER)/How-to-secure-your-WHMCS-installation.md
	rm -rf $(SDKFOLDER)/create-phar.php $(SDKFOLDER)/build $(SDKFOLDER)/tests $(SDKFOLDER)/.github $(SDKFOLDER)/*.json $(SDKFOLDER)/.releaserc.json $(SDKFOLDER)/.dependabot $(SDKFOLDER)/scripts 
	rm -rf $(LIBFOLDER)/.dependabot $(LIBFOLDER)/Country.php $(LIBFOLDER)/.github $(LIBFOLDER)/scripts $(LIBFOLDER)/package.json $(LIBFOLDER)/release.config.js
	find $(LIBFOLDER) ! \( -name "*.php" -o -name "*.tpl" -o -name "*.png" -o -name "*.js" -o -name "*.json" -o -name "" \) -type f -exec rm -f {} \;

	# convert all necessary files to html
	find $(DOCFOLDER) -maxdepth 1 -name "*.md" -exec bash -c 'pandoc "$${0}" -f markdown -t html -s --self-contained -o "$${0/\.md/}.html"' {} \;
	pandoc $(DOCFOLDER)/LICENSE -t html -s --self-contained -o $(DOCFOLDER)/LICENSE.html
	rm -rf $(DOCFOLDER)/*.md $(DOCFOLDER)/LICENSE
	# replacements in html files
	find $(DOCFOLDER) -maxdepth 1 -name "*.html" -exec bash -c 'sed -i -e "s/https:\/\/github\.com\/hexonet\/$(REPOID)\/wiki/\./g" "$${0}"' {} \;
	find $(DOCFOLDER) -maxdepth 1 -name "*.html" -exec bash -c 'sed -i -e "s/https:\/\/github\.com\/hexonet\/$(REPOID)\/blob\/master/\./g" "$${0}"' {} \;
	find $(DOCFOLDER) -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(DOCFOLDER)/Contact-Us.html"' {} \;
	find $(DOCFOLDER) -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(DOCFOLDER)/CONTRIBUTING.html"' {} \;
	find $(DOCFOLDER) -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(DOCFOLDER)/Development-Guide.html"' {} \;
	find $(DOCFOLDER) -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(DOCFOLDER)/HISTORY.html"' {} \;
	find $(DOCFOLDER) -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(DOCFOLDER)/LICENSE.html"' {} \;
	find $(DOCFOLDER) -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(DOCFOLDER)/README.html"' {} \;
	find $(DOCFOLDER) -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(DOCFOLDER)/Release-Notes.html"' {} \;
	find $(DOCFOLDER) -maxdepth 1 -name "*.html" -exec bash -c 'm=$$(basename -- "$${0}"); l="$${m/\.html/}"; sed -i -e "s|\.\/$$l|\.\/$$m|g" "$(DOCFOLDER)/Usage-Guide.html"' {} \;
	find $(DOCFOLDER) -maxdepth 1 -name "*.html" -exec bash -c 'sed -i -e "s/\.html\.md/\.html/g" "$${0}"' {} \;
	find $(FOLDER)/install -name "*~" | xargs rm -f
	find $(FOLDER)/install -name "*.bak" | xargs rm -f

buildlatestzip:
	cp pkg/$(REPOID).zip ./$(REPOID)-latest.zip

zip:
	@echo $(VERSION);
	rm -rf pkg/$(REPOID).zip
	@$(MAKE) buildsources
	cd pkg && zip -r $(REPOID).zip $(REPOID)-$(VERSION)
	@$(MAKE) clean

tar:
	@echo $(VERSION)
	rm -rf pkg/$(REPOID).tar.gz
	@$(MAKE) buildsources
	cd pkg && tar -zcvf $(REPOID).tar.gz $(REPOID)-$(VERSION)
	@$(MAKE) clean

allarchives:
	@echo $(VERSION)
	rm -rf pkg/$(REPOID).zip
	rm -rf pkg/$(REPOID).tar
	@$(MAKE) buildsources
	cd pkg && zip -r $(REPOID).zip $(REPOID)-$(VERSION) && tar -zcvf $(REPOID).tar.gz $(REPOID)-$(VERSION)
	@$(MAKE) buildlatestzip
	@$(MAKE) clean
