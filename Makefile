.PHONY: install uninstall test

IMAGE = calculator_image
CONTAINER = calculator

install:
	@ docker build --no-cache -t $(IMAGE) .

uninstall:
	@ docker rmi $(IMAGE)

test:
	@ docker run --rm --name $(CONTAINER) -v $(PWD):/var/www $(IMAGE)

