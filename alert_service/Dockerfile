FROM python:3.11.3-slim
WORKDIR /dir
RUN pip install mycli
RUN apt-get update &&\
    apt-get install -y sendemail &&\
    apt-get install -y libnet-ssleay-perl &&\
    apt-get install -y libio-socket-ssl-perl
COPY ./extract.sh .
CMD ["./extract.sh"]