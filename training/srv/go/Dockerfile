
FROM sureifylabs/gobase-dev:latest

EXPOSE 8080

WORKDIR /go

ADD . .

RUN cd src/api && \
	go build -o api main.go

ENTRYPOINT ["./start.sh"]