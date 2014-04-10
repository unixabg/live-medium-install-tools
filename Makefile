# Makefile

SHELL := sh -e

LANGUAGES = $(shell cd manpages/po && ls)

SCRIPTS = scripts/*

all: build

test:
	@echo -n "Checking for syntax errors"

	@for SCRIPT in $(SCRIPTS); \
	do \
		sh -n $${SCRIPT}; \
		echo -n "."; \
	done

	@echo " done."

	@echo -n "Checking for bashisms"

	@if [ -x /usr/bin/checkbashisms ]; \
	then \
		for SCRIPT in $(SCRIPTS); \
		do \
			checkbashisms -f -x $${SCRIPT}; \
			echo -n "."; \
		done; \
	else \
		echo "WARNING: skipping bashism test - you need to install devscripts."; \
	fi

	@echo " done."

build:
	@echo "Nothing to build."

install-client:
	# Installing executables
	mkdir -p $(DESTDIR)/usr/lib/live-medium-install-tools
	cp -a scripts/firmware.* $(DESTDIR)/usr/lib/live-medium-install-tools

	# Installing shared data
	mkdir -p $(DESTDIR)/usr/share/live-medium-install-tools
	cp -r share/* $(DESTDIR)/usr/share/live-medium-install-tools

	# Installing documentation
	mkdir -p $(DESTDIR)/usr/share/doc/live-medium-install-tools
	cp -r COPYING README $(DESTDIR)/usr/share/doc/live-medium-install-tools

	# Install crontab
	install -D -m 0644 examples/firmware.injection.crontab $(DESTDIR)/etc/cron.d/firmware.injection

uninstall-client:
	# Uninstalling executables
	rm -rf $(DESTDIR)/usr/live/live-medium-install-tools

	# Uninstalling shared data
	rm -rf $(DESTDIR)/usr/share/live-medium-install-tools

	# Uninstalling documentation
	rm -rf $(DESTDIR)/usr/share/doc/live-medium-install

	# Uninstall crontab
	rm -f $(DESTDIR)/etc/cron.d/firmware.injection

clean:

distclean:

reinstall-client: uninstall-client install-client
